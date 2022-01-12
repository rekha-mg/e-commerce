<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;

class ProductController extends Controller
{
    //
     public function sendResponse($success, $result, $message, $response_code)
	{
		$response = [
			'success' => true,
			'data'    => $result,
			'message' => $message,
		];
		return response()->json($response, $response_code);
	}

	public function displayAllProducts(Request $request)
	{
		Log::info('Display all product: ');

		try {
				$res = DB::select('select count(*) as total from product');
				Log::info('Total number of product ' . $res[0]->total);
				$total_product = $res[0]->total;
				if ($total_product > 5) {
					$total_product = DB::select('select * from product limit ?', [$limit]);
				} else {
					$total_product = DB::select('select *  from product');
				}
			} catch (\PDOException $pex) {
	           	Log::critical('some error: ' . print_r($pex->getMessage(), true)); //xampp off
	           	return $this->sendResponse("false", "", 'error related to database', 500);
       		} catch (\Exception $e) {
		       	Log::critical('some error: ' . print_r($e->getMessage(), true));
		       	Log::critical('error line: ' . print_r($e->getLine(), true));
		       	return $this->sendResponse("false", "", 'some error in server', 500);
       		}
       		
       		return $this->sendResponse("true", $total_product, 'request completed', 200);
      }

    public function displayOneProduct(Request $req, $product_id)
   		{
   			if ($product_id > 0) {
   			try {
   					Log::info('Showing product details of : ' . $product_id);
   					$product=DB::select('select product.product_id, product.product_name, product.price, product.quantity, product_attributes_assoc.brand, product_attributes_assoc.expire_date from product join product_attributes_assoc on product.product_id = product_attributes_assoc.product_id_fk=?',[$product_id]);
   					
   				} catch (\PDOException $pex) {
                	Log::critical('some error: ' . print_r($pex->getMessage(), true)); //xampp off
                	return $this->sendResponse("false", "", 'error related to database', 500);
            	} catch (\Exception $e) {
            		Log::critical('some error: ' . print_r($e->getMessage(), true));
            		Log::critical('error line: ' . print_r($e->getLine(), true));
            		return $this->sendResponse("false", "", 'some error in server', 500);
            	}
        	} else {
        	return $this->sendResponse("false", "", 'some error in user id', 500);
        }
        return $this->sendResponse("true", $product, 'request completed', 200);
    }

	public function addNewProduct(request $request){
		$error="";
		$product_id=$request->input('product_id');
		$product_name=$request->input('product_name');
		$price=$request->input('price');
		$quantity=$request->input('quantity');
		$weight=$request->input('weight');

		$brand=$request->input('brand');
		$manufacture_date=$request->input('manufacture_date');
		$expire_date=$request->input('expire_date');

		$category_id=$request->input('category_id');

		if($product_id==""){
			$error.="Provide product_id ";
		} 
		/*if($product_name==""){
			$error.="provide product name ";
		}
		if($price==""){
			$error.="provide product price";
		}	
		if($quantity==""){
			$error.="Provide quanity of product";
		}
        if($weight==""){
        	$error.="Provide product weigth";
        }
        if($brand==""){
        	$error.=" Provide product brand";
        }
        if($manufacture_date==""){
        	$error.=" Provide product manufacture_date";
        }
        if($expire_date==""){
        	$error.=" Provide product expire_date";
        }*/
        if($category_id==""){
        	$error.=" Provide  category id";
        }

        if($error){
			return $this->sendResponse("false","",$error ,401);
		} else{
			try{
			
				/*$resp1=DB::insert('insert into product(product_id,product_name,price,quantity,weight) values (?,?,?,?,?)',[$product_id,$product_name,$price,$quantity,$weight]);
				Log::info('Inserted new product table :'.$resp1);
				
			
				$resp2=DB::insert('insert into product_attributes_assoc(product_id_fk, brand, manufacture_date,expire_date) values (?,?,?,?)',[$product_id,$brand,$manufacture_date,$expire_date]);
				Log::info('Inserted new product attributes  assoc:'.$resp2);
				return $this->sendResponse("true", $product_id, 'inserted data successfully', 200);*/

				/*$resp3=DB::insert('insert into product_image(product_id, product_image) values (?,?)',[$product_id,$product_image]);
				Log::info('Inserted new product image '.$resp3);
				return $this->sendResponse("true",$product_id,'data inserted successfully',200);*/

				$resp4=DB::insert('insert into product_category(product_id, category_id) values (?,?)',[$product_id,$category_id]);
				Log::info('Inserted new product category :'.$resp4);

			} catch(\Exception $e) {
				Log::critical('some error:'.print_r($e->getMessage(),true));
				Log::critical('error line: '.print_r($e->getLine(), true));
				return $this->sendResponse("false","",'some error in server',500);
			}  

		}


	}
}
