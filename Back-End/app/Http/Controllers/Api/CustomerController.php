<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Resources\CustomerResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;


class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::get();
        if ($customers->count() > 0) {
            return CustomerResource::collection($customers);
        } else {
            return response()->json(['message' => 'No record available'], 200);
        }
    }

    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create($request->validated());


        return response()->json([
            'message' => 'New Customer Created Successfully',
            'data' => new CustomerResource($customer)
        ], 200);
    }

    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {

        $customer->update($request->validated());
        
        return response()->json([
            'message' => 'New Customer Created Successfully',
            'data' => new CustomerResource($customer)
        ], 200);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json([
            'message'=> 'Customer Deleted Successfully',
        ],200);
    }
}
