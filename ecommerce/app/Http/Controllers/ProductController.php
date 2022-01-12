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



}
