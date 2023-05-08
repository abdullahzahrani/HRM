<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
//    public function index()
//    {
//        $usr = Auth()->user();
//        $date = Carbon::parse($usr->last_login_at);
//        $elapsed = $date->diffForHumans(Carbon::now());
//
//        $reqs = \App\Models\ApplyLeaveRequest::where('user_id', "=",$usr->id)
//            ->where(function($query) {
//                $query->where('LM_type', '=', null)
//                    ->orWhere('HR_type', '=', null);
//            })->get();
//        $reqs1 = \App\Models\ApplyLeaveRequest::where('user_id', "=",$usr->id)
//            ->where(function($query) {
//                $query->where('LM_type', '!=', null)
//                    ->Where('HR_type', '!=', null);
//            })->get();
//
//        $viceClockNumber = $usr->clock_number;
//
//        $req3 = User::where('vice_clock_number', $viceClockNumber)
//            ->where('flag', true)
//            ->get()
//            ->pluck('clock_number');
//
//        $qw5 = \App\Models\ApplyLeaveRequest::whereIn('LM', $req3)
//            ->get()
//            ->toArray();
//dd($qw5);
//        return view('home',compact('elapsed','reqs','reqs1'));
//    }

    public function index()
    {
        $user = Auth()->user();
        $date = Carbon::parse($user->last_login_at);
        $elapsed = $date->diffForHumans(Carbon::now());


        $MNLeaveRequests = \App\Models\ApplyLeaveRequest::where('LM', $user->clock_number)->get();

        $pendingLeaveRequestsLM = $MNLeaveRequests->filter(function ($request) {
            return is_null($request->LM_type);
        });
        $approvedLMRequestsLM = $MNLeaveRequests->filter(function ($request) {
            return !is_null($request->LM_type);
        });

        $userLeaveRequests = \App\Models\ApplyLeaveRequest::where('user_id', $user->id)->get();

        $pendingLeaveRequests = $userLeaveRequests->filter(function ($request) {
            return is_null($request->LM_type) || is_null($request->HR_type);
        });

         $approvedRequests = $userLeaveRequests->filter(function ($request) {
            return !is_null($request->LM_type) && !is_null($request->HR_type);
        });

        $viceClockNumber = $user->vice_clock_number;

        $viceClockNumber = auth()->user()->clock_number;

        $viceLeaveRequests = \App\Models\ApplyLeaveRequest::whereIn('LM', function ($query) use ($viceClockNumber) {
            $query->select('clock_number')
                ->from('users')
                ->where('vice_clock_number', $viceClockNumber)
                ->where('flag', true);
        })->whereNull('LM_type')
            ->get();


        return view('home', compact('elapsed', 'pendingLeaveRequestsLM',
            'approvedLMRequestsLM','approvedRequests','pendingLeaveRequests','viceLeaveRequests'));
    }

    public function profile(){
        return view('profile');
    }
    public function profile2(Request $request){

        if ($request['flag']){
            auth()->user()->flag = 1;
            auth()->user()->save();
        }else{
            auth()->user()->flag = 0;
            auth()->user()->save();
        }

        if ($request['clock']){
            auth()->user()->clock_number = $request['clock'];
            auth()->user()->save();
        }else{
            auth()->user()->clock_number = $request['clock'];
            auth()->user()->save();
        }
        return redirect()->route('profile');
    }
}
