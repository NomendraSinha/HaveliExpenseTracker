<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;

class HETController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::all();
        return view('manageexpenses.index')->with('expenses',$expenses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required',
            'amount' => 'required|numeric|between:10,99999',
            'purpose' => 'required|min:7|max:100',
        ]);

        $status = 1;
        $exception = '';
        try{
            $expenses = new Expense;
            $expenses->create($request->all());
        }
        catch(Exception $e){
            $status = 0;
            $exception = $e;
        }
        return redirect()->route('manage-expenses.index')->with(['status'=>$status,'exception'=>$exception]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'id' => 'required|exists:expenses',
            'date' => 'required',
            'amount' => 'required|numeric|between:10,99999',
            'purpose' => 'required|min:7|max:100',
        ]);

        $status = 1;
        $exception = '';
        try{
            $expenses = Expense::find($id);
            $expenses->update($request->all());
        }
        catch(Exception $e){
            $status = 0;
            $exception = $e;
        }
        return redirect()->route('manage-expenses.index')->with(['status'=>$status,'exception'=>$exception]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expense::find($id)->delete();
        return redirect()->route('manage-expenses.index')->with('dstatus',1);
    }
}
