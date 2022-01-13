<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;

class OrderController extends Controller
{
	  public function sendResponse($success, $result, $message, $response_code)
	{
		$response = [
			'success' => true,
			'data'    => $result,
			'message' => $message,
		];
		return response()->json($response, $response_code);
	}
	public function displayAllOrders(Request $request)
	{
		Log::info('Display all Orders: ');
		try {
				$res = DB::select('select count(*) as total from order_details');
				Log::info('Total number of orders ' . $res[0]->total);
				$orders = $res[0]->total;
				$orders = DB::select('select * from order_details ');
				return $this->sendResponse("true", $orders, 'request completed', 200);
				
			} catch (\Exception $e) {
		       	Log::critical('some error: ' . print_r($e->getMessage(), true));
		       	Log::critical('error line: ' . print_r($e->getLine(), true));
		       	return $this->sendResponse("false", "", 'some error in server', 500);
       		}
       		
       		
      }


      public function displayOneOrder(Request $req,$order_id){
      	try {
   					Log::info('Showing order details of : ' . $order_id);
   					$order=DB::select('select * from order_details where order_id=?',[$order_id]);
   					return $this->sendResponse("true", $order, 'request completed', 200);
   					
   				} catch (\Exception $e) {
            		Log::critical('some error: ' . print_r($e->getMessage(), true));
            		Log::critical('error line: ' . print_r($e->getLine(), true));
            		return $this->sendResponse("false", "", 'some error in server', 500);
            	}
        	
        	return $this->sendResponse("false", "", 'some error in user id', 500);
      }

       public function addNewOrder(Request $request){
		    $error="";
		    $status="order palced";

			$order_details_id=$request->input('order_details_id');
			$order_id=$request->input('order_id');
			$product_id=$request->input('product_id');
			$coupon_id=$request->input('coupon_id');
			$quantity=$request->input('quantity');
			$payment_id=$request->input('payment_id');
			$shippingaddress=$request->input('shippingaddress');
			$shippingmethod_id=$request->input('shippingmethod_id');



			if($order_details_id==""){
				$error.=" Provide order_details_id ";
			}
			if($order_id==""){
				$error.=" Provide order_id ";
			}
			if($product_id==""){
				$error.=" Provide product_id";
			}
			if($coupon_id==""){
				$error.=" Provide coupon_id ";
			}
			if($quantity==""){
				$error.=" Provide quantity";
			}
			if($payment_id==""){
				$error.="Provide payment_id ";
			}
			if($shippingaddress==""){
				$error.="Provide shipping address";
			}
			if($shippingmethod_id==""){
				$error.="Provide shipping method";
			}
	
			if($error){
				return $this->sendResponse("false","",$error ,401);
			} else{
				try{
					$resp1=DB::insert('insert into order_details(order_details_id,order_id,product_id,coupon_id,quantity,payment_id,shippingaddress,shippingmethod_id,status) values (?,?,?,?,?,?,?,?,?)',[$order_details_id,$order_id,$product_id,$coupon_id,$quantity,$payment_id,$shippingaddress,$shippingmethod_id,$status]);
					Log::info('Inserted new Customer :'.$resp1);
					return $this->sendResponse("true",$order_id,'ordered data inserted successfully',200);

					} 
					catch(\Exception $e) {
						Log::critical('some error:'.print_r($e->getMessage(),true));
						Log::critical('error line: '.print_r($e->getLine(), true));
						return $this->sendResponse("false","",'some error in server',500);
					}  	
				
				}
			}


	public function updateOrder(Request $request, $order_details_id)
	{
			$error="";
    		$order_details_id=$request->input('order_details_id');
			$order_id=$request->input('order_id');
			$product_id=$request->input('product_id');
			$coupon_id=$request->input('coupon_id');
			$quantity=$request->input('quantity');
			$payment_id=$request->input('payment_id');
			$shippingaddress=$request->input('shippingaddress');
			$shippingmethod_id=$request->input('shippingmethod_id');

			if($order_details_id==""){
				$error.=" Provide order_details_id ";
			}
			if($order_id==""){
				$error.=" Provide order_id ";
			}
			if($product_id==""){
				$error.=" Provide product_id";
			}
			if($coupon_id==""){
				$error.=" Provide coupon_id ";
			}
			if($quantity==""){
				$error.=" Provide quantity";
			}
			if($payment_id==""){
				$error.="Provide payment_id ";
			}
			if($shippingaddress==""){
				$error.="Provide shipping address";
			}
			if($shippingmethod_id==""){
				$error.="Provide shipping method";
			}
			$status="order placed";
	
			if($error){
				return $this->sendResponse("false","",$error ,401);
			} else{
				try{
					$resp1=DB::update('update  order_details set  order_id=?, product_id=?,coupon_id=? ,quantity=? ,payment_id=?,shippingaddress=?,shippingmethod_id=?,status=? where order_details_id=?',[$order_id, $product_id, $coupon_id, $quantity, $payment_id, $shippingaddress, $shippingmethod_id, $status, $order_details_id]);
						Log::info('Inserted new Customer :'.$resp1);
						return $this->sendResponse("true",$order_id,'ordered data updated successfully',200);
					} 
					catch(\Exception $e) {
						Log::critical('some error:'.print_r($e->getMessage(),true));
						Log::critical('error line: '.print_r($e->getLine(), true));
						return $this->sendResponse("false","",'some error in server',500);
					}  	
				
				} 	
	}


	public function deleteOrder($order_id){
    	$error="";
    	$status="cancelled ";
    	if($order_id==""){
    		$error="Provide order id";
    	}
    	try{
    		$resp1=DB::update('update order_details set status=? where order_id=?',[$status,$order_id]);
    		return $this->sendResponse("true",$resp1,'customer data deleted',200);
    	}
    	catch(\Exception $e){
            Log::critical('some error:'.print_r($e->getMessage(),true));
            Log::critical('error line: '.print_r($e->getLine(),true));
            return $this->sendResponse("false","",'some error in server',500);
    	}  	
   
   			return $this->sendResponse("false","",'some error in input',500);
   			Log::info('deleted customer details: '.$customer_id);
    }
    
}
