<?php

namespace App\Interfaces\API;

use App\Http\Requests\API\CreateMedicationRequest;
use App\Http\Requests\API\LoginRequest;
use App\Http\Requests\API\UpdateMedicationRequest;
use Illuminate\Http\Request;

interface MedicationAPIInterface {

    //retrieve all medications
    public function index(Request $request);

    //create medications
    public function store(CreateMedicationRequest $request);

    //retrive specific medication for id
    public function show($id);

    //updates the medication details
    public function update(UpdateMedicationRequest $request);

    //permanently remove of soft deletes
    public function destroy($id);
}

