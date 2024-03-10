<?php

namespace App\Interfaces\API;

use App\Http\Requests\API\CreateCustomerRequest;
use App\Http\Requests\API\UpdateCustomerRequest;
use Illuminate\Http\Request;

interface CustomerAPIInterface {

    //retrieve all customers
    public function index(Request $request);

    //create customers
    public function store(CreateCustomerRequest $request);

    //retrive specific customers for id
    public function show($id);

    //updates the customer details
    public function update(UpdateCustomerRequest $request);

    //permanently remove of soft deletes
    public function destroy($id);
}

