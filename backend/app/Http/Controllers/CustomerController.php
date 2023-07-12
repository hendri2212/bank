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
    // public function masuk() {
        // $check_login = Auth::attempt($request->only('email', 'password'), false);
        // if (!$check_login) {
        //     return response()->json('Gagal', 500);
        // }
        // return Auth::id();
        // if (Auth::attempt(["email"=>$request->email, 'password'=>$request->password])){
        //     return response()->json('Berhasil', 200);
        // }
        
        $check_login = Auth::guard('customer')->attempt($request->only('nisn'), false);
        if (!$check_login) {
            return response()->json('Gagal', 500);
        }
        return Auth::id();
        // return Auth::guard('customer')->check();
        // return response()->json('Berhasil', 200);
        // return auth()->user()->createToken("customer-token", ['insert', 'update'])->plainTextToken;
        // return auth()->user()->createToken("user-token", ['insert', 'update'], now()->modify('+1 hour'))->plainTextToken;
        // return auth()->user()->createToken("user-token", ['insert', 'update'], now()->modify('+2 minute'))->plainTextToken;
        // return auth()->user()->createToken([
        //     'name' => "admin-token",
        //     'abilities' => "*",
        //     'expires_at' => 60,
        // ]);
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
