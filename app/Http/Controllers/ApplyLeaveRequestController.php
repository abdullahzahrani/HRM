<?php

namespace App\Http\Controllers;

use App\Models\ApplyLeaveRequest;
use App\Models\User;
use Illuminate\Http\Request;


class ApplyLeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $u = User::pluck('name', 'clock_number');

        return view('applyLeaveRequest.index', compact('u'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
//    public function store(Request $request)
//    {
//        $rs = formatString($request['inputName5']);
//
//        $exp = explode("-", $rs);
//
//
//        $qwer = User::
//            where('clock_number', $exp[1])
//            ->firstOrFail();
//
//        if (str_replace(' ', '',$qwer->name) !== $exp[0]){return redirect()->route('req');}
//
//
//
//        $this->validate($request, [
//            'inputName5' => 'required',
//            'inputSubject5'=>'required|max:25',
//            'inputTel'=>'required|integer|digits_between:6,18',
//            'inputEmail5' => 'required|email',
//            'inputCountry' => 'required|max:25',
//
//            'ASR' => 'required|integer|between:0,1',
//            'inputDateFR' => 'required|date',
//            'inputDateTO' => 'required|date',
//            'leaveType'=>'required',
//            'floatingTextarea' =>'min:3|max:1000',
//            'file' => 'mimes:pdf|max:2048',
//
//        ]);
//
//        $app = new ApplyLeaveRequest();
//
//        $app->LM = $qwer->clock_number;
//        $app->Subject = $request['inputSubject5'];
//        $app->personal_email = $request['inputEmail5'];
//        $app->emergency_tel = $request['inputTel'];
//        $app->country_of_domicile = $request['inputCountry'];
//        $app->user_id = auth()->id();
////       ---------------------
//        $app->ASR = $request['ASR'];
//        $app->FROM = $request['inputDateFR'];
//        $app->TO = $request['inputDateTO'];
//        $app->leave_type = $request['leaveType'];
//        $app->comments = $request['floatingTextarea'];
////        ---------------------
//
//        if ($request['ASR2'] or $request['inputDateFR2'] or $request['inputDateTO2'] or $request['leaveType2'] != null) {
//            $this->validate($request, [
//                'ASR2' => 'required|integer|between:0,1',
//                'inputDateFR2' => 'required|date',
//                'inputDateTO2' => 'required|date',
//                'leaveType2'=>'required',
//            ]);
//            $app->ASR2 = $request['ASR2'];
//            $app->FROM2 = $request['inputDateFR2'];
//            $app->TO2 = $request['inputDateTO2'];
//            $app->leave_type2 = $request['leaveType2'];
//
//        }
//        if ($request['ASR3'] or $request['inputDateFR3'] or $request['inputDateTO3'] or $request['leaveType3'] != null) {
//            $this->validate($request, [
//                'ASR3' => 'required|integer|between:0,1',
//                'inputDateFR3' => 'required|date',
//                'inputDateTO3' => 'required|date',
//                'leaveType3'=>'required',
//            ]);
//            $app->ASR3 = $request['ASR3'];
//            $app->FROM3 = $request['inputDateFR3'];
//            $app->TO3 = $request['inputDateTO3'];
//            $app->leave_type3 = $request['leaveType3'];
//        }
//        if ($request['ASR4'] or $request['inputDateFR4'] or $request['inputDateTO4'] or $request['leaveType4'] != null) {
//            $this->validate($request, [
//                'ASR4' => 'required|integer|between:0,1',
//                'inputDateFR4' => 'required|date',
//                'inputDateTO4' => 'required|date',
//                'leaveType4'=>'required',
//            ]);
//            $app->ASR4 = $request['ASR4'];
//            $app->FROM4 = $request['inputDateFR4'];
//            $app->TO4 = $request['inputDateTO4'];
//            $app->leave_type4 = $request['leaveType4'];
//        }
//
//
//        $app->LM_type = null;
//        $app->HR_type = null;
//        if ($request->file()) {
//            $fileName = \Auth::user()->clock_number.'-'.time() . '_' . $request->file->getClientOriginalName();
//            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
//            $app->file_name = time() . '_' . $request->file->getClientOriginalName();
//            $app->file_path = '/storage/' . $filePath;
//        }
//        $app->save();
//        return "done";
//    }
public function __construct()
{
    $this->middleware('auth');
}

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'inputName5' => 'required',
            'inputSubject5' => 'required|max:25',
            'inputTel' => 'required|integer|digits_between:6,18',
            'inputEmail5' => 'required|email',
            'inputCountry' => 'required|max:25',

            'ASR' => 'required|integer|between:0,1',
            'inputDateFR' => 'required|date',
            'inputDateTO' => 'required|date',
            'leaveType' => 'required',
            'floatingTextarea' => 'min:3|max:1000',
            'file' => 'mimes:pdf|max:2048',
        ]);

        $rs = $this->formatString($validatedData['inputName5']);
        $exp = explode("-", $rs);

        $qwer = User::where('clock_number', $exp[1])->firstOrFail();
        if (str_replace(' ', '', $qwer->name) !== $exp[0]) {
            return redirect()->route('req');
        }

        $app = new ApplyLeaveRequest();
        $app->LM = $qwer->clock_number;
        $app->Subject = $validatedData['inputSubject5'];
        $app->personal_email = $validatedData['inputEmail5'];
        $app->emergency_tel = $validatedData['inputTel'];
        $app->country_of_domicile = $validatedData['inputCountry'];
        $app->user_id = auth()->id();
        $app->ASR = $validatedData['ASR'];
        $app->FROM = $validatedData['inputDateFR'];
        $app->TO = $validatedData['inputDateTO'];
        $app->leave_type = $validatedData['leaveType'];
        $app->comments = $validatedData['floatingTextarea'];

        $this->addAdditionalLeaveRequest($request, $app, 2);
        $this->addAdditionalLeaveRequest($request, $app, 3);
        $this->addAdditionalLeaveRequest($request, $app, 4);

        $app->LM_type = null;
        $app->HR_type = null;

        if ($request->file()) {
            $fileName = \Auth::user()->clock_number . '-' . time() . '_' . $request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $app->file_name = time() . '_' . $request->file->getClientOriginalName();
            $app->file_path = '/storage/' . $filePath;
        }

        $app->save();

        return redirect()->route('home');
    }

    private function addAdditionalLeaveRequest($request, $app, $index)
    {
        if ($request["ASR$index"] or $request["inputDateFR$index"] or $request["inputDateTO$index"] or $request["leaveType$index"]) {
            $validatedData = $request->validate([
                "ASR$index" => 'required|integer|between:0,1',
                "inputDateFR$index" => 'required|date',
                "inputDateTO$index" => 'required|date',
                "leaveType$index" => 'required',
            ]);

            $app->{"ASR$index"} = $validatedData["ASR$index"];
            $app->{"FROM$index"} = $validatedData["inputDateFR$index"];
            $app->{"TO$index"} = $validatedData["inputDateTO$index"];
            $app->{"leave_type$index"} = $validatedData["leaveType$index"];
        }
    }

    /**
     * Display the specified resource.
     */
    private function formatString($str)
    {
        $str = preg_replace("/[^a-zA-Z0-9]/", "", $str); // remove special characters
        $str = preg_replace("/([a-zA-Z])([0-9])/", "$1-$2", $str); // separate letters and numbers with a hyphen
        $str = preg_replace("/([0-9])([a-zA-Z])/", "$1-$2", $str); // separate numbers and letters with a hyphen

        $letters = "";
        $numbers = "";

        if (empty($str) || ctype_alpha($str) || ctype_digit($str) || preg_match("/[a-zA-Z]$/", $str)) {
            $str = "ABC-000"; // set default value
        } else {
            // split string into letters and numbers
            preg_match("/([a-zA-Z]+)-([0-9]+)/", $str, $matches);
            $letters = $matches[1];
            $numbers = $matches[2];

            // check if letters or numbers are empty
            if (empty($letters) || empty($numbers)) {
                $str = "ABC-000"; // set default value
            } else {
                $str = "$letters-$numbers"; // format output as "letters-numbers"
            }
        }

        return $str;
    }

    public function show(ApplyLeaveRequest $applyLeaveRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApplyLeaveRequest $applyLeaveRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
//    public function update(Request $request,$id)
//    {
//        $MNLeaveRequests = \App\Models\ApplyLeaveRequest::where('LM', auth()->user()->clock_number)
//            ->where('id', '=', Str::of($id)->replace('/[^0-9]/', '')->trim())
//            ->first();
//        $viceClockNumber = auth()->user()->clock_number;
//
//        $viceLeaveRequests = \App\Models\ApplyLeaveRequest::whereIn('LM', function ($query) use ($viceClockNumber) {
//            $query->select('clock_number')
//                ->from('users')
//                ->where('vice_clock_number', $viceClockNumber)
//                ->where('flag', true);
//        })->where('id','=',Str::of($id)->replace('/[^0-9]/', '')->trim())
//            ->get();
//
//        if (!is_null($MNLeaveRequests) or!is_null($viceLeaveRequests) ){
//            $MNLeaveRequests->LM_type = 1;
//            $MNLeaveRequests->save();
//        }
//    return redirect()->route('home');
//    }

//    public function update(Request $request, $id)
//    {
//        $cleanedId =  filter_var($id, FILTER_SANITIZE_NUMBER_INT);;
//
//        $selfLeaveRequest = \App\Models\ApplyLeaveRequest::where('LM', auth()->user()->clock_number)
//            ->where('id', $cleanedId)
//            ->first();
//
//        $viceClockNumber = auth()->user()->clock_number;
//
//        $viceLeaveRequests = \App\Models\ApplyLeaveRequest::whereIn('LM', function ($query) use ($viceClockNumber) {
//            $query->select('clock_number')
//                ->from('users')
//                ->where('vice_clock_number', $viceClockNumber)
//                ->where('flag', true);
//        })->where('id', $cleanedId)
//            ->get();
//
//        if (!is_null($selfLeaveRequest)) {
//            $selfLeaveRequest->LM_type = 1;
//            $selfLeaveRequest->save();
//        }
//        if (!is_null($viceLeaveRequests)) {
//            $viceLeaveRequests->LM_type = 1;
//            $viceLeaveRequests->save();
//        }
//
//        return redirect()->route('home');
//    }
    public function update($id)
    {
        $cleanedId = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        $selfLeaveRequest = \App\Models\ApplyLeaveRequest::where('LM', auth()->user()->clock_number)
            ->where('id', $cleanedId)->whereNull('LM_type')
            ->first();

        $viceClockNumber = auth()->user()->clock_number;

        $viceLeaveRequests = optional(\App\Models\ApplyLeaveRequest::whereIn('LM', function ($query) use ($viceClockNumber) {
            $query->select('clock_number')
                ->from('users')
                ->where('vice_clock_number', $viceClockNumber)
                ->where('flag', true);
        })->where('id', $cleanedId)->whereNull('LM_type')
            ->get());

        tap($selfLeaveRequest, function ($leaveRequest) {
            if ($leaveRequest) {
                $leaveRequest->update([
                    'LM_type' => 1,
                ]);
            }
        });

        if ($viceLeaveRequests !== null) {
            $viceLeaveRequests->each(function ($leaveRequest) {
                $leaveRequest->update([
                    'LM_type' => 1,
                ]);
            });
        }

        return redirect()->route('home');
    }
    public function pupdate($id)
    {
        $cleanedId = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        $selfLeaveRequest = \App\Models\ApplyLeaveRequest::where('LM', auth()->user()->clock_number)
            ->where('id', $cleanedId)->whereNull('LM_type')
            ->first();

        $viceClockNumber = auth()->user()->clock_number;

        $viceLeaveRequests = optional(\App\Models\ApplyLeaveRequest::whereIn('LM', function ($query) use ($viceClockNumber) {
            $query->select('clock_number')
                ->from('users')
                ->where('vice_clock_number', $viceClockNumber)
                ->where('flag', true);
        })->where('id', $cleanedId)->whereNull('LM_type')
            ->get());

        tap($selfLeaveRequest, function ($leaveRequest) {
            if ($leaveRequest) {
                $leaveRequest->update([
                    'LM_type' => 0,
                ]);
            }
        });

        if ($viceLeaveRequests !== null) {
            $viceLeaveRequests->each(function ($leaveRequest) {
                $leaveRequest->update([
                    'LM_type' => 0,
                ]);
            });
        }

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApplyLeaveRequest $applyLeaveRequest)
    {
        //
    }

}
