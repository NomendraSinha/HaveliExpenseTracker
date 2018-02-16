<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Expense;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('home');
        return $exp_info = DB::table('expenses')
             ->join('users','expenses.user_id','=','users.id')
             ->select('user_id', 'users.id', DB::raw('count(*) as total'))
             ->groupBy('user_id','users.id')
             ->get();
        return $exptrashedcount = Expense::onlyTrashed()->get()->count();
        //return $expcount = Expense::all()->count();
        //return $userscount = User::all()->count(); 
        return view('myhome');
    }
}
