<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CreateCustomerRequest;
use App\Http\Requests\API\UpdateCustomerRequest;
use App\Interfaces\API\CustomerAPIInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerAPIController extends BaseAPIController{

    private CustomerAPIInterface $customerAPIInterface;

    //used services
    public function __construct(CustomerAPIInterface $customerAPIInterface)
    {
        $this->middleware('auth:sanctum');
        $this->customerAPIInterface = $customerAPIInterface;
    }

    /**
     * Display a listing of the customers.
     */
    public function index(Request $request)
    {
        try{
            
            if(Auth::user()->can('view_customers')){

                //returns the medication retrieve response
                $response = $this->customerAPIInterface->index($request);

                return $this->sendResponse(true,Response::HTTP_OK,'Retrieveing available customers !', $response);

            }else{

                return $this->sendResponse(false,Response::HTTP_OK,env("ACCESS_DENIED_MESSAGE"), null);

            }

        }catch(\Exception $exception){

            Log::channel('medication_error_log')->info("[Customers Retrieve Log] ==> customer retrieve error occured - ".$exception);

            return $this->sendResponse(false,Response::HTTP_OK,'customers retrieve error ', $exception->getMessage());
        }
    }


    /**
     * Store a newly created customer in storage.
     */
    public function store (CreateCustomerRequest $request)
    {
        try{

            if(Auth::user()->can('add_customers')){

                DB::beginTransaction();

                //returns the customer creation response
                $response = $this->customerAPIInterface->store($request);

                DB::commit();

                return $this->sendResponse(true,Response::HTTP_OK,'customer creation !', $response);

            }else{

                return $this->sendResponse(false,Response::HTTP_OK,env("ACCESS_DENIED_MESSAGE"), null);

            }

        }catch(\Exception $exception){

            DB::rollBack();
            
            Log::channel('customer_error_log')->info("[customers Create Log] ==> customer create error occured - ".$exception);

            return $this->sendResponse(false,Response::HTTP_OK,'customers create error ', $exception->getMessage());
        }
    }

    /**
     * Display the specified customer.
     */
    public function show($id)
    {
        try{

            if(Auth::user()->can('view_customers')){

                //returns the customer retrieve by id response
                $response = $this->customerAPIInterface->show($id);

                return $this->sendResponse(true,Response::HTTP_OK,'Retrieveing customer by id !', $response);

            }else{

                return $this->sendResponse(false,Response::HTTP_OK,env("ACCESS_DENIED_MESSAGE"), null);

            }

        }catch(\Exception $exception){

            Log::channel('customer_error_log')->info("[customer Retrieve Log] ==> customer retrieve by id error occured - ".$exception);

            return $this->sendResponse(false,Response::HTTP_OK,'customers retrieve by id error ', $exception->getMessage());
        }
    }


    /**
     * Update the specified customer in storage.
     */
    public function update(UpdateCustomerRequest $request)
    {
        try{

            if(Auth::user()->can('edit_customers')){

                DB::beginTransaction();

                //returns the customer update response
                $response = $this->customerAPIInterface->update($request);

                DB::commit();

                return $this->sendResponse(true,Response::HTTP_OK,'Update customers success !', $response);

            }else{

                return $this->sendResponse(false,Response::HTTP_OK,env("ACCESS_DENIED_MESSAGE"), null);

            }

        }catch(\Exception $exception){

            DB::rollBack();

            Log::channel('customer_error_log')->info("[customers Log] ==> customer update error occured - ".$exception);

            return $this->sendResponse(false,Response::HTTP_OK,'customers update error ', $exception->getMessage());
        }
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy($id)
    {
        try{

            if(Auth::user()->can('delete_customers')){

                DB::beginTransaction();

                //returns the customer delete response
                $response = $this->customerAPIInterface->destroy($id);

                DB::commit();

                return $this->sendResponse(true,Response::HTTP_OK,'Deleting customers !', $response);

            }else{

                return $this->sendResponse(false,Response::HTTP_OK,env("ACCESS_DENIED_MESSAGE"), null);

            }

        }catch(\Exception $exception){

            DB::rollBack();

            Log::channel('customer_error_log')->info("[customers Log] ==> customer delete error occured - ".$exception);

            return $this->sendResponse(false,Response::HTTP_OK,'customers delete error ', $exception->getMessage());
        }
    }
}
