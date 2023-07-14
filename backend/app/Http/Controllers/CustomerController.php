<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Customer::all();
    }

    public function masuk(Request $request) {
        $check_login = Auth::guard('customer')->attempt($request->only('nisn', 'password'), false);
        if (!$check_login) {
            return response()->json('Gagal', 500);
        }
        // return Auth::guard('customer')->id();
        // return response()->json('Berhasil', 200);
        return Auth::guard('customer')->user()->createToken("customer-token", ['insert', 'update'])->plainTextToken;
        // return Auth::guard('customer')->user()->createToken("customer-token", ['insert', 'update'], now()->modify('+1 hour'))->plainTextToken;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $save = new Customer;
        $save->nisn     = $request->nisn;
        $save->password = Hash::make('password');
        $save->save();
        return response()->json('Success', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
