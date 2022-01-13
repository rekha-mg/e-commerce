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
				$total_customer = DB::select('select * from customer limit ?', [$limit]);
			} else {
				$users_list = DB::select('select *  from customer where status=?',['active']);
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
	    $error="";
		$customer_name=$request->input('customer_name');
		$first_name=$request->input('first_name');
		$last_name=$request->input('last_name');
		$user_name=$request->input('user_name');
		$password=$request->input('password');
		$phone=$request->input('phone');

		$address_id=$request->input('address_id');
		$address1=$request->input('address1');
		$address2=$request->input('address2');
		$street=$request->input('street');
		$city=$request->input('city');
		$state=$request->input('state');
		$pincode=$request->input('pincode');
    	
    	$customer_id=$request->input('customer_id_fk');

		if($customer_id==""){
			$error+="Provide customer_id ";
		} 
		if( $first_name==""){
			$error+="Provide first_name ";
		}
		if($last_name==""){
			$error+="Provide last_name ";
		} 
		if($user_name==""){
			$error+="Provide user_name ";
		} 
		if ($password==""){
			$error+="Provide password ";
		}
		if($phone==""){
			$error+="Provide phone number ";
		} 
		if($address_id==""){
			$error+="Provide address id ";
		}
		if($address1==""){
			$error+="Provide address1 ";
		}
		if($address2==""){
			$error+="Provide address2 ";
		}
		if($city==""){
			$error+="Provide city ";
		}
		if($state==""){
			$error+="provid state";
		}
		if($pincode==""){
			$error+="Provide pincode";
		}

		if($error){
			return $this->sendResponse("false","",$error ,401);
		} else{
			try{
			
				$resp1=DB::insert('insert into customer(customer_id,customer_name) values (?,?)',[$customer_id,$customer_name]);
				Log::info('Inserted new Customer :'.$resp1);
			
				$resp2=DB::insert('insert into customer_details(customer_id_fk,first_name,last_name,user_name,password,phone) values (?,?,?,?,?,?)',[$customer_id,$first_name,$last_name,$user_name,$password,$phone]);
				Log::info('Inserted new customer details:'.$resp2);

				$resp3=DB::insert('insert into customer_address(address_id,customer_id_fk,address1,address2,street,city,state,pincode) values (?,?,?,?,?,?,?,?)',[$address_id,$customer_id,$address1,$address2,$street,$city,$state,$pincode]);
				Log::info('Inserted new customer address'.$resp3);
				return $this->sendResponse("true",$customer_id,'data inserted successfully',200);


			} catch(\Exception $e) {
				Log::critical('some error:'.print_r($e->getMessage(),true));
				Log::critical('error line: '.print_r($e->getLine(), true));
				return $this->sendResponse("false","",'some error in server',500);
			}  	
		}

				
   	
    }


    public function updateCustomer(Request $request, $customer_id)
    {
    	$error="";
		$customer_name=$request->input('customer_name');
		 	
    	if($customer_name==""){
    		$error.="Provide customer name";
    	}
      	
		if($error){
			return $this->sendResponse("false","",$error ,401);
		} else{
			try{
				$resp1 = DB::update('update customer set customer_name = ? where customer_id = ?', [$customer_name,$customer_id]);
    			Log::info('updated customer :'. $resp1);
    					
				return $this->sendResponse("true",$customer_id,'data updated successfully',200);

			} catch(\Exception $e) {
				Log::critical('some error:'.print_r($e->getMessage(),true));
				Log::critical('error line: '.print_r($e->getLine(), true));
				return $this->sendResponse("false","",'some error in server',500);
			}  	
		}



         
    }
    public function updateCustomerDetails(Request $request, $customer_id)
    {
    	$error="";
	
		$first_name=$request->input('first_name');
		$last_name=$request->input('last_name');
		$user_name=$request->input('user_name');
		$password=$request->input('password');
		$phone=$request->input('phone');

		  	
    	if( $first_name==""){
			$error.="Provide first_name ";
		}
		if($last_name==""){
			$error.="Provide last_name ";
		} 
		if($user_name==""){
			$error.="Provide user_name ";
		} 
		if ($password==""){
			$error.="Provide password ";
		}
		if($phone==""){
			$error.="Provide phone number ";
		} 
		
		if($error){
			return $this->sendResponse("false","",$error ,401);
		} else{
			try{
					$resp2 = DB::update('update customer_details set first_name = ?, last_name=?, user_name=?, password=?, phone=? where customer_id_fk = ?', [$first_name,$last_name,$user_name, $password, $phone, $customer_id]);
	    			Log::info('updated customer details:'. $resp2);
    				return $this->sendResponse("true",$customer_id,'customer details data updated successfully',200);

				} catch(\Exception $e) {
					Log::critical('some error:'.print_r($e->getMessage(),true));
					Log::critical('error line: '.print_r($e->getLine(), true));
					return $this->sendResponse("false","",'some error in server',500);
				}  	
			}
        
    }


    public function updateCustomerAddress(Request $request, $customer_id)
    {
    	$error="";
	
		$address_id=$request->input('address_id');
		$address1=$request->input('address1');
		$address2=$request->input('address2');
		$street=$request->input('street');
		$city=$request->input('city');
		$state=$request->input('state');
		$pincode=$request->input('pincode');
    	    	
    	if($address_id==""){
			$error.="Provide address id ";
		}
		if($address1==""){
			$error.="Provide address1 ";
		}
		if($address2==""){
			$error.="Provide address2 ";
		}
		if($city==""){
			$error.="Provide city ";
		}
		if($state==""){
			$error.="provid state";
		}
		if($pincode==""){
			$error.="Provide pincode";
		}

		if($error){
			return $this->sendResponse("false","",$error ,401);
		} else{
			try{
					$resp3 = DB::update('update customer_address set address1 = ?, address2=?,street=?,city=?,state=?,pincode=? where customer_id_fk = ?', [$address1,$address2,$street,$city,$state,$pincode,$customer_id]);
	    			Log::info('updated customer :'. $resp3);
   								
					return $this->sendResponse("true",$customer_id,'Address data updated successfully',200);
				} catch(\Exception $e) {
					Log::critical('some error:'.print_r($e->getMessage(),true));
					Log::critical('error line: '.print_r($e->getLine(), true));
					return $this->sendResponse("false","",'some error in server',500);
				}  	
			}
       
    }

    public function deleteCustomer($customer_id){
    	$error="";
    	$status="inactive";
    	if($customer_id==""){
    		$error="Provide customer id";
    	}
    	try{
    		$resp1=DB::update('update customer set status=? where customer_id=?',[$status,$customer_id]);
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
