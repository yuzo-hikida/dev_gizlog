<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Report;
use Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $report;

    public function __construct(Report $instanceClass)
    {
        $this->report = $instanceClass;
    }

    public function index(Request $request)
    {
        // $reports = $this->report->getByUserId(Auth::id());
        // return view('user.daily_report.index', compact('reports'));

        // dd($request);
            $select = $request->input('search-month');
            // dd($select);
        if (empty($select))
        {
            $reports = $this->report->getByUserId(Auth::id());
            return view('user.daily_report.index', compact('reports'));
        } else {
            $reports = $this->report->getByReportingTime($select);
            dd($reports);
            return view('user.daily_report.index', compact('reports'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user.daily_report.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        $input= $request->all();
        $input['user_id'] = Auth::id();
        // dd($input);
        $this->report->fill($input)->save();
        return redirect()->route('report.index');
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
        $report = $this->report->find($id);
        return view('user.daily_report.show', compact('report'));
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
        $report = $this->report->find($id);
        // dd($report);
        return view('user.daily_report.edit', compact('report'));
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
        //
        // dd($id);
        $input = $request->all();
        // dd($input);
        $this->report->find($id)->fill($input)->save();
        return redirect()->route('report.index');
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
        // dd($id);
        $this->report->find($id)->delete();
        return redirect()->route('report.index');
    }
}
