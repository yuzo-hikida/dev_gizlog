<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\User\AbsenceRequest;
use App\Models\Attendance;
use App\Http\Controllers\Controller;
use App\Http\Requests\ModifyRequest;
use App\Providers\AttendancesServiceProvider;

class AttendanceController extends Controller
{
    protected $attendance;

    public function __construct(Attendance $attendance)
    {
        $this->middleware('auth');
        $this->attendance = $attendance;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendanceStatus = $this->attendance->discriminationAttend();
        return view('user.attendance.index', compact('attendanceStatus'));
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
        $startTime = $this->attendance->saveStartTime();
        return redirect()->route('attendance.index');
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
        $this->attendance->saveEndTime($id);
        return redirect()->route('attendance.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 欠席登録ページ遷移
     */
    public function absence()
    {
        return view('user.attendance.absence');
    }

    /**
     * 欠席登録
     */
    public function absenceRegistration(AbsenceRequest $request)
    {
        $absenceComment = $request->all();
        $this->attendance->saveAbsence($absenceComment);
        return redirect()->route('attendance.index');
    }

    /**
     * mypageページ遷移
     */
    public function mypage()
    {
        $myRecords = $this->attendance->getMyRecords();
        $cumulativeTime = $this->attendance->getCumulativeTime();
        return view('user.attendance.mypage', compact('myRecords', 'cumulativeTime'));
    }

    /**
     * 編集画面遷移
     */
    public function modify()
    {
        return view('user.attendance.modify');
    }

    /**
     * 修正登録
     * @rreturn 一覧画面
     */
    public function correctionRegistration(ModifyRequest $request)
    {
        $correctionDate = $request->all();
        $this->attendance->saveCorrectionDate($correctionDate);
        return redirect()->route('attendance.index');
    }
}
