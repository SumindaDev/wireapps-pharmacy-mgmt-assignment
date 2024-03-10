<?php

namespace App\Services\API;

use App\Http\Requests\API\CreateMedicationRequest;
use App\Http\Requests\API\UpdateMedicationRequest;
use App\Http\Resources\API\MedicationAPIResource;
use App\Interfaces\API\MedicationAPIInterface;
use App\Models\Medication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicationAPIService implements MedicationAPIInterface {


    //retrieve all medications
    public function index(Request $request){

        $medications = Medication::where(function($query) use($request){

            if($request->searchKey != null){

                $query->where('name','like','%'.$request->searchKey.'%');

            }else{

                $query;
            }
        })
        ->where('status',1)->get();

        //returning medications
        return array(
            'status' => true,
            'message' => 'Medication retrieveing !',
            'payload' => MedicationAPIResource::collection($medications)

        );

    }

    //create medications
    public function store(CreateMedicationRequest $request){

        $medication = new Medication();

        $medication->name = $request->name;
        $medication->code = $request->code;
        $medication->description = $request->description;
        $medication->quantity = $request->quantity;
        $medication->price = $request->price;
        $medication->status = $request->status;

        $medication->save();

        return array(
            'status' => true,
            'message' => 'Medication created successfully !',
            'payload' => MedicationAPIResource::make($medication)

        );

    }

    //retrive specific medication for id
    public function show($id){

        $medication = Medication::where('id',$id)->get()->first();

        if($medication != null){

            return array(
                'status' => true,
                'message' => 'Medication found !',
                'payload' => MedicationAPIResource::make($medication)

            );

        }else{

            return array(
                'status' => false,
                'message' => 'Could not find the medication',
                'payload' => null

            );
        }
    }

    //updates the medication details
    public function update(UpdateMedicationRequest $request){

        $medication = Medication::where('id',$request->medication_id)->get()->first();

        if($medication != null){

            $medication->name = $request->name;
            $medication->code = $request->code;
            $medication->description = $request->description;
            $medication->quantity = $request->quantity;
            $medication->price = $request->price;
            $medication->status = $request->status;
    
            $medication->save();

            return array(
                'status' => true,
                'message' => 'Medication updated successfully !',
                'payload' => MedicationAPIResource::make($medication)

            );
            
        }else{

            return array(
                'status' => false,
                'message' => 'Could not find the medication',
                'payload' => null

            );
        }

    }

    //permanently remove or soft delete medications
    public function destroy($id){

        $medicationDeleted = 0; 

        if(Auth::user()->can('delete_medication')){
            //permamently delete

            $medicationDeleted = Medication::where('id',$id)->forceDelete();


        }else{
            //using soft deletes
            $medicationDeleted = Medication::where('id',$id)->delete();
        }

        if($medicationDeleted){

            return array(
                'status' => true,
                'message' => 'Medication deleted successfully !',
                'payload' => null

            );

        }else{

            return array(
                'status' => false,
                'message' => 'Medication deletion failed !',
                'payload' => null

            );


        }
    }
    
}

