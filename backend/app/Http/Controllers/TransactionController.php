<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // return Transaction::all();
        return Transaction::with('User')->get();
        // return Transaction::with('User', 'Customer')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $balance = Transaction::where('customer_id', $request->customer_id)->latest('id')->first();
        
        if (empty($balance)) {
            if ($request->type == 'Debet' && $request->amount >= 0) {
                // return response()->json("Anda Belum Pernah Menabung", 404);
                return redirect()->back()->with('alert','hello');
            } else {
                $total = $request->amount;
            }
        } else {
            if ($request->type == 'Credit') {
                $total = $balance->balance+$request->amount;
            } else {
                if ($request->amount > $balance->balance || $request->amount == 0) {
                    return response()->json("Tabungan Anda Tidak Mencukupi", 404);
                } else {
                    $total = $balance->balance-$request->amount;
                }
            }
        }
        // DB::beginTransaction();
        // try {
            // return Transaction::create($request->all());
            $save = new Transaction;
            $save->description  = $request->description;
            $save->type         = $request->type;
            $save->amount       = $request->amount;
            $save->balance      = $total;
            $save->user_id      = $request->user_id;
            $save->customer_id  = $request->customer_id;
            $save->save();
            
            // DB::commit();
            return response()->json('Success', 200);
        // } catch (Exception $e) {
        //     DB::rollBack();
        //     if ($request->type=='Debet' && $request->amount > $balance->amount) {
        //         return response()->json("Kepala keluarga tidak ditemukan", 404);
        //     }
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction) {
        return Transaction::with('User')->where('customer_id', $transaction->customer_id)->get();
        // $data = Transaction::where('customer_id', $transaction->id)->first();
        // if (empty($data)) {
        //     echo "Kosong";
        // } else {
        //     return $data;
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
