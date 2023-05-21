<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (auth::id()==1) {
            return User::all();
        } else {
            return User::where('role', '!=', 'superadmin')->get();
        }
    }

    public function login(Request $request) {
        $check_login = Auth::attempt($request->only('email', 'password'), false);
        if (!$check_login) {
            return response()->json('Gagal', 500);
        }
        return auth()->user()->createToken("user-token", ['insert', 'update'])->plainTextToken;
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
        $validatedData = $request->validate([
            'name'      => 'required|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6',
            'status'    => 'required'
        ]);

        $user = new User;
        $user->name     = $validatedData['name'];
        $user->email    = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->role     = $validatedData['role'];
        $user->save();

        return response()->json("Employee Registered", 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        // return auth::id();
        return Auth::User();
    }

    public function edit(Request $request, $user) {
        return User::find($user);
        // return response()->json('Success', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $update = new User;
        $update = User::find($id);
        if (empty($request->password)) {
            $update->name       = $request->name;
            $update->email      = $request->email;
            $update->role       = $request->role;
            $update->save();
        } else {
            $update->name       = $request->name;
            $update->email      = $request->email;
            $update->password   = Hash::make($request->password);
            $update->role       = $request->role;
            $update->save();
        }
        return response()->json('Success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id) {
    public function destroy(Request $request, $id) {
        $request->user()->currentAccessToken()->delete();
        return response()->json("Logout", 200);
    }
}