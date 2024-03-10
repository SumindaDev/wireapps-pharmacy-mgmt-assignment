<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMedicationRequest;
use App\Http\Requests\API\UpdateMedicationRequest;
use App\Interfaces\API\MedicationAPIInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MedicationAPIController extends BaseAPIController
{
    private MedicationAPIInterface $medicationAPIInterface;

    //used services
    public function __construct(MedicationAPIInterface $medicationAPIInterface)
    {
        $this->middleware('auth:sanctum');
        $this->medicationAPIInterface = $medicationAPIInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{

            if(Auth::user()->can('view_medication')){

                //returns the medication retrieve response
                $response = $this->medicationAPIInterface->index($request);

                return $this->sendResponse(true,Response::HTTP_OK,'Retrieveing available medications !', $response);

            }else{

                return $this->sendResponse(false,Response::HTTP_OK,env("ACCESS_DENIED_MESSAGE"), null);

            }

        }catch(\Exception $exception){

            Log::channel('medication_error_log')->info("[Medications Retrieve Log] ==> medication retrieve error occured - ".$exception);

            return $this->sendResponse(false,Response::HTTP_OK,'Medications retrieve error ', $exception->getMessage());
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store (CreateMedicationRequest $request)
    {
        try{

            if(Auth::user()->can('add_medication')){

                DB::beginTransaction();

                //returns the medication creation response
                $response = $this->medicationAPIInterface->store($request);
    
                DB::commit();
    
                return $this->sendResponse(true,Response::HTTP_OK,'Medication creation !', $response);

            }else{

                return $this->sendResponse(false,Response::HTTP_OK,env("ACCESS_DENIED_MESSAGE"), null);

            }

          

        }catch(\Exception $exception){

            DB::rollBack();

            Log::channel('medication_error_log')->info("[Medications Create Log] ==> medication create error occured - ".$exception);

            return $this->sendResponse(false,Response::HTTP_OK,'Medications create error ', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{

            if(Auth::user()->can('view_medication')){

                //returns the medication retrieve by id response
                $response = $this->medicationAPIInterface->show($id);

                return $this->sendResponse(true,Response::HTTP_OK,'Retrieveing medication by id !', $response);

            }else{

                return $this->sendResponse(false,Response::HTTP_OK,env("ACCESS_DENIED_MESSAGE"), null);

            }

        }catch(\Exception $exception){

            Log::channel('medication_error_log')->info("[Medication Retrieve Log] ==> medication retrieve by id error occured - ".$exception);

            return $this->sendResponse(false,Response::HTTP_OK,'Medications retrieve by id error ', $exception->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicationRequest $request)
    {
        try{

            if(Auth::user()->can('edit_medication')){

                DB::beginTransaction();

                //returns the medication update response
                $response = $this->medicationAPIInterface->update($request);

                DB::commit();

                return $this->sendResponse(true,Response::HTTP_OK,'Update medications success !', $response);

            }else{

                return $this->sendResponse(false,Response::HTTP_OK,env("ACCESS_DENIED_MESSAGE"), null);

            }

        }catch(\Exception $exception){

            DB::rollBack();
            
            Log::channel('medication_error_log')->info("[Medications Log] ==> medication update error occured - ".$exception);

            return $this->sendResponse(false,Response::HTTP_OK,'Medications update error ', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{

            if(Auth::user()->can('delete_medication') or Auth::user()->can('temp_delete_medication')){

                DB::beginTransaction();
                
                //returns the medication delete response
                $response = $this->medicationAPIInterface->destroy($id);

                DB::commit();

                return $this->sendResponse(true,Response::HTTP_OK,'Deleting medications !', $response);

            }else{

                return $this->sendResponse(false,Response::HTTP_OK,env("ACCESS_DENIED_MESSAGE"), null);

            }

        }catch(\Exception $exception){

            DB::rollBack();

            Log::channel('medication_error_log')->info("[Medications Log] ==> medication delete error occured - ".$exception);

            return $this->sendResponse(false,Response::HTTP_OK,'Medications delete error ', $exception->getMessage());
        }
    }
}
