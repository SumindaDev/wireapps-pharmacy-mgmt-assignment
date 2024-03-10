<?php

namespace App\Services\API;

use App\Http\Requests\API\CreateCustomerRequest;
use App\Http\Requests\API\UpdateCustomerRequest;
use App\Http\Resources\API\CustomerAPIResource;
use App\Interfaces\API\CustomerAPIInterface;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAPIService implements CustomerAPIInterface {


    //retrieve all medications
    public function index(Request $request){

        $customers = Customer::where(function($query) use($request){

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
            'message' => 'Customers retrieveing !',
            'payload' => CustomerAPIResource::collection($customers)

        );

    }

    //create medications
    public function store(CreateCustomerRequest $request){

        $customer = new Customer();

        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->status = $request->status;

        $customer->save();

        return array(
            'status' => true,
            'message' => 'customer created successfully !',
            'payload' => CustomerAPIResource::make($customer)

        );

    }

    //retrive specific medication for id
    public function show($id){

        $customer = Customer::where('id',$id)->get()->first();

        if($customer != null){

            return array(
                'status' => true,
                'message' => 'Customer found !',
                'payload' => CustomerAPIResource::make($customer)

            );

        }else{

            return array(
                'status' => false,
                'message' => 'Could not find the customer',
                'payload' => null

            );
        }
    }

    //updates the medication details
    public function update(UpdateCustomerRequest $request){

        $customer = Customer::where('id',$request->customer_id)->get()->first();

        if($customer != null){

            $customer->name = $request->name;
            $customer->address = $request->address;
            $customer->phone = $request->phone;
            $customer->email = $request->email;
            $customer->status = $request->status;
    
            $customer->save();

            return array(
                'status' => true,
                'message' => 'Customer updated successfully !',
                'payload' => CustomerAPIResource::make($customer)

            );
            
        }else{

            return array(
                'status' => false,
                'message' => 'Could not find the customer',
                'payload' => null

            );
        }

    }

    //permanently remove or soft delete medications
    public function destroy($id){

        $customerDeleted = 0; 

        if(Auth::user()->can('delete_customers')){
            //permamently delete

            $customerDeleted = Customer::where('id',$id)->forceDelete();


        }else{
            //using soft deletes
            $customerDeleted = Customer::where('id',$id)->delete();
        }

        if($customerDeleted){

            return array(
                'status' => true,
                'message' => 'Customer deleted successfully !',
                'payload' => null

            );

        }else{

            return array(
                'status' => false,
                'message' => 'Customer deletion failed !',
                'payload' => null

            );


        }
    }
    
}

