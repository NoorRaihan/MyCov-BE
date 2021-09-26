<?php

namespace App\Http\Controllers;

use App\Models\report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = $request->id;
        $reports = report::where('reported_by',$user_id)->get();

        if($reports) {
            return [
                'Success' => true,
                'Report' => $reports
            ];
        }else {
            return [
                'Success' => false,
                'Message' => 'Something went wrong'
            ];
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Report = new report;
        $Report->description = $request->description;
        $Report->lat = $request->lat;
        $Report->lng = $request->lng;
        $Report->reported_by = $request->id;
        $saved = $Report->save();
        if($saved) {
            return [
                'Success' => true,
                'Message' => 'Report successfully created'    
            ];
        }else {
            return [
                'Success' => false,
                'Message' => 'Something went wrong'    
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(report $report)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user_id = $request->id;
        $report_id = $request->report_id;
        $delete = report::where('reported_by',$user_id)->where('id',$report_id)->first()->delete();

        if($delete) {
            return [
                'Success' => true,
                'Message' => 'Report successfully deleted'
            ];
        }else {
            return [
                'Success' => false,
                'Message' => 'Something went wrong'
            ];
        }
    }
}
