<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;

class EmployeeController extends Controller
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

	public function displayAllEmployee(Request $request)
	{
		Log::info('Display all employee: ');
		try {
				$res = DB::select('select count(*) as total from employee');
				Log::info('Total number of employee ' . $res[0]->total);
				$employee = $res[0]->total;
				$employee = DB::select('select * from employee ');
				return $this->sendResponse("true", $employee, 'request completed', 200);
				
			} catch (\Exception $e) {
		       	Log::critical('some error: ' . print_r($e->getMessage(), true));
		       	Log::critical('error line: ' . print_r($e->getLine(), true));
		       	return $this->sendResponse("false", "", 'some error in server', 500);
       		}
       		
       		
      }

      public function displayOneEmployee(Request $req, $employee_id)
   		{
   			try {
   					Log::info('Showing employee details of : ' . $employee_id);
   					$product=DB::select('select * from employee where emp_id=?',[$employee_id]);
   					return $this->sendResponse("true", $product, 'request completed', 200);
   					
   				} catch (\Exception $e) {
            		Log::critical('some error: ' . print_r($e->getMessage(), true));
            		Log::critical('error line: ' . print_r($e->getLine(), true));
            		return $this->sendResponse("false", "", 'some error in server', 500);
            	}
        	
        	return $this->sendResponse("false", "", 'some error in user id', 500);
        }
        

        public function addNewEmployee(Request $request){
		    $error="";

			$first_name=$request->input('first_name');
			$last_name=$request->input('last_name');
			$user_name=$request->input('user_name');
			$password=$request->input('password');
			if($first_name==""){
				$error.=" Provide first name ";
			}
			if($last_name==""){
				$error.=" Provide last name ";
			}
			if($user_name==""){
				$error.=" Provide login user name";
			}
			if($password==""){
				$error.=" Provide login password ";
			}
	
			if($error){
				return $this->sendResponse("false","",$error ,401);
			} else{
				try{
					$resp1=DB::insert('insert into employee(first_name,last_name,loging_username,login_password) values (?,?,?,?)',[$first_name,$last_name,$user_name,$password]);
					Log::info('Inserted new Customer :'.$resp1);
					return $this->sendResponse("true",$customer_id,'data inserted successfully',200);

					} 
					catch(\Exception $e) {
						Log::critical('some error:'.print_r($e->getMessage(),true));
						Log::critical('error line: '.print_r($e->getLine(), true));
						return $this->sendResponse("false","",'some error in server',500);
					}  	
				
				}
			}
    

}
