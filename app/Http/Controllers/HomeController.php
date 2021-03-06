<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Expense;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Helpers\Helper;

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
        $today = Carbon::now();
        $thismonth = $today->format('Y-m').'-01';
        $lastmonth = $today->subMonth()->format('Y-m').'-01';
        $exp_thismonth = DB::table('expenses')
             ->join('users','expenses.user_id','=','users.id')
             ->where('date','>=',$thismonth)
             ->select('user_id', 'users.name', DB::raw('count(*) as count'), DB::raw('sum(amount) as sum'))
             ->groupBy('user_id','users.name')
             ->get();
        $exp_lastmonth = DB::table('expenses')
             ->join('users','expenses.user_id','=','users.id')
             ->where('date','>=',$lastmonth)
             ->where('date','<',$thismonth)
             ->select('user_id', 'users.name', DB::raw('count(*) as count'), DB::raw('sum(amount) as sum'))
             ->groupBy('user_id','users.name')
             ->get();
        $exp_total_thismonth = Expense::where('date','>=',$thismonth)->sum('amount');
        $exp_total_lastmonth = Expense::where('date','>=',$lastmonth)
             ->where('date','<',$thismonth)->sum('amount');
        $exptrashedcount_this = Expense::where('date','>=',$thismonth)->onlyTrashed()->get()->count();
        $expcount_this = Expense::where('date','>=',$thismonth)->count();
        $userscount = User::all()->count();
        $exptrashedcount_last = Expense::where('date','>=',$lastmonth)
             ->where('date','<',$thismonth)->onlyTrashed()->get()->count();
        $expcount_last = Expense::where('date','>=',$lastmonth)
             ->where('date','<',$thismonth)->count();; 

        return view('myhome')->with(
            [
                'exp_this'=>$exp_thismonth,
                'exp_last'=>$exp_lastmonth,
                'exp_total'=>$exp_total_thismonth, 
                'exp_total_per_diff'=>Helper::get_per_diff($exp_total_lastmonth,$exp_total_thismonth), 
                'exptrashedcount'=>$exptrashedcount_this, 
                'exptrashedcount_per_diff'=>Helper::get_per_diff($exptrashedcount_last,$exptrashedcount_this),
                'expcount'=>$expcount_this,
                'expcount_per_diff'=>Helper::get_per_diff($expcount_last,$expcount_this), 
                'userscount'=>$userscount,
            ]);
    }
    public function filtered(Request $request)
    {
        //return view('home');
        $monthint = $request->input('monthfilter');
        if($monthint!=10 || $monthint!=11 || $monthint!=12){
            $monthint = '0'.$monthint;
        }
        $today = Carbon::createFromFormat('Y-m', Carbon::now()->format('Y').'-'.$monthint);
        $today2 = Carbon::createFromFormat('Y-m', Carbon::now()->format('Y').'-'.$monthint);
        $thismonth = $today->format('Y-m').'-01';
        $lastmonth = $today->subMonth()->format('Y-m').'-01';
        $nextmonth = $today2->addMonth()->format('Y-m').'-01';
        $exp_thismonth = DB::table('expenses')
             ->join('users','expenses.user_id','=','users.id')
             ->where('date','>=',$thismonth)
             ->where('date','<',$nextmonth)
             ->select('user_id', 'users.name', DB::raw('count(*) as count'), DB::raw('sum(amount) as sum'))
             ->groupBy('user_id','users.name')
             ->get();
        $exp_lastmonth = DB::table('expenses')
             ->join('users','expenses.user_id','=','users.id')
             ->where('date','>=',$lastmonth)
             ->where('date','<',$thismonth)
             ->select('user_id', 'users.name', DB::raw('count(*) as count'), DB::raw('sum(amount) as sum'))
             ->groupBy('user_id','users.name')
             ->get();
        $exp_total_thismonth = Expense::where('date','>=',$thismonth)->where('date','<',$nextmonth)->sum('amount');
        $exp_total_lastmonth = Expense::where('date','>=',$lastmonth)
             ->where('date','<',$thismonth)->sum('amount');
        $exptrashedcount_this = Expense::where('date','>=',$thismonth)->where('date','<',$nextmonth)->onlyTrashed()->get()->count();
        $expcount_this = Expense::where('date','>=',$thismonth)->where('date','<',$nextmonth)->count();
        $userscount = User::all()->count();
        $exptrashedcount_last = Expense::where('date','>=',$lastmonth)
             ->where('date','<',$thismonth)->onlyTrashed()->get()->count();
        $expcount_last = Expense::where('date','>=',$lastmonth)
             ->where('date','<',$thismonth)->count();; 

        return view('myhome')->with(
            [
                'exp_this'=>$exp_thismonth,
                'exp_last'=>$exp_lastmonth,
                'exp_total'=>$exp_total_thismonth, 
                'exp_total_per_diff'=>Helper::get_per_diff($exp_total_lastmonth,$exp_total_thismonth), 
                'exptrashedcount'=>$exptrashedcount_this, 
                'exptrashedcount_per_diff'=>Helper::get_per_diff($exptrashedcount_last,$exptrashedcount_this),
                'expcount'=>$expcount_this,
                'expcount_per_diff'=>Helper::get_per_diff($expcount_last,$expcount_this), 
                'userscount'=>$userscount,
                'monthfilterval'=>$monthint,
            ]);
    }
}
