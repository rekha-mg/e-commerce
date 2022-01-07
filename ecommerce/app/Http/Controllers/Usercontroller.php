<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;


class Usercontroller extends Controller
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

	public function displayAllusers(Request $request)
	{
		Log::info('Display all users: ');

		try {
			$res = DB::select('select count(*) as total from users');
			Log::info('Total number of users ' . $res[0]->total);
			$total_users = $res[0]->total;
			if ($total_users > 5) {
				$users_list = DB::select('select * from users limit ?', [$limit]);
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
       return $this->sendResponse("true", $users_list, 'request completed', 200);

      }


    public function displayOneuser(Request $req, $user_id)
   		{
   			if ($user_id > 0) {
   			try {
   					Log::info('Showing user details of : ' . $user_id);
   					$user = DB::select('select * from users where userid = ?', [$user_id]);
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
        return $this->sendResponse("true", $user, 'request completed', 200);
    }
}
