<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;


class CustomerController extends Controller
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

	public function displayAllcustomer(Request $request)
	{
		Log::info('Display all customers: ');

		try {
			$res = DB::select('select count(*) as total from customer');
			Log::info('Total number of customers ' . $res[0]->total);
			$total_customer = $res[0]->total;
			if ($total_customer > 5) {
				$total_customer = DB::select('select * from users limit ?', [$limit]);
			} else {
				$users_list = DB::select('select *  from users');
			}
		} catch (\PDOException $pex) {
           Log::critical('some error: ' . print_r($pex->getMessage(), true)); //xampp off
           return $this->sendResponse("false", "", 'error related to database', 500);
       } catch (\Exception $e) {
       	Log::critical('some error: ' . print_r($e->getMessage(), true));
       	Log::critical('error line: ' . print_r($e->getLine(), true));
       	return $this->sendResponse("false", "", 'some error in server', 500);
       }
       return $this->sendResponse("true", $total_customer, 'request completed', 200);

      }

        public function displayOnecustomer(Request $req, $customer_id)
   		{
   			if ($customer_id > 0) {
   			try {
   					Log::info('Showing customer details of : ' . $customer_id);
   					$customer=DB::select('select customer.customer_id, customer_details.first_name, customer_details.phone, customer_address.address1 from customer join customer_details on customer.customer_id = customer_details.customer_id_fk join customer_address on customer_details.customer_id_fk= customer_address.customer_id_fk=?',[$customer_id]);
   					
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
        return $this->sendResponse("true", $customer, 'request completed', 200);
    }

    public function addNewCustomer(Request $request){
    	if($request->has('customer_id_fk') && $request->has('address_id') && $request->has('address1') && $request->has('address2') && $request->has('street') && $request->has('city') && $request->has('state') && $request->has('pincode'))
    	// && $request->has('first_name') && $request->has('last_name') && $request->has('user_name') && $request->has('password')&& $request->has('phone'))
    	{
    		$customer_id=$request->input('customer_id_fk');
    		/*$customer_name=$request->input('customer_name');
    		$first_name=$request->input('first_name');
    		$last_name=$request->input('last_name');
    		$user_name=$request->input('user_name');
    		$password=$request->input('password');
    		$phone=$request->input('phone');*/

    		$address_id=$request->input('address_id');
    		$address1=$request->input('address1');
    		$address2=$request->input('address2');
    		$street=$request->input('street');
    		$city=$request->input('city');
    		$state=$request->input('state');
    		$pincode=$request->input('pincode');
    		try{
    			/*$resp = DB::insert('insert into chits (chit_name,capital_amount,total_members,payment,duration,start_date,ending_date) values(?,?,?,?,?,?,?)',[$chit_name,$capital_amount,$total_members,$payment,$duration,$start_date,$ending_date]);
    			Log::info('Inserted new chit :'. $resp); */

    			// $resp=DB::insert('insert into customer(customer_id,customer_name) values (?,?)',[$customer_id,$customer_name]);
    			// Log::info('Inserted new Customer :'.$resp);
    		
    			//$resp2=DB::insert('insert into customer_details(customer_id_fk,first_name,last_name,user_name,password,phone) values (?,?,?,?,?,?)',[$customer_id,$first_name,$last_name,$user_name,$password,$phone]);
    			//Log::info('Inserted new customer details:'.$resp2);

    			$resp3=DB::insert('insert into customer_address(address_id,customer_id_fk,address1,address2,street,city,state,pincode) values (?,?,?,?,?,?,?,?)',[$address_id,$customer_id,$address1,$address2,$street,$city,$state,$pincode]);
    			Log::info('Inserted new customer address'.$resp3);
    		}


    		catch(\PDOException $pex){
				Log::critical('some error: '.print_r($pex->getMessage(),true)); //xampp off
				return $this->sendResponse("false", "",'error related to database', 500);
			}  
			catch(\Exception $e){
				Log::critical('some error:'.print_r($e->getMessage(),true));
				Log::critical('error line: '.print_r($e->getLine(), true));
				return $this->sendResponse("false","",'some error in server',500);
			}  		
	}
	else{
				Log::warning('input data missing' .print_r($request->input('street'),true));
    			return $this->sendResponse("input data missing",'', 'incorrect request', 500); //wrong field name
    		}
    			return $this->sendResponse("true",$resp3,'data inserted successfully', 201);
   	
    }

}
