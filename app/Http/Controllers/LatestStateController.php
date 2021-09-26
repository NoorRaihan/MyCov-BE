<?php

namespace App\Http\Controllers;

use App\Models\LatestState;
use Illuminate\Http\Request;

class LatestStateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $state = $request->state;
        $case = LatestState::where('state', $state)->get();
        return response()->json($case,200);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LatestState  $latestState
     * @return \Illuminate\Http\Response
     */
    public function show(LatestState $latestState)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LatestState  $latestState
     * @return \Illuminate\Http\Response
     */
    public function edit(LatestState $latestState)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LatestState  $latestState
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LatestState $latestState)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LatestState  $latestState
     * @return \Illuminate\Http\Response
     */
    public function destroy(LatestState $latestState)
    {
        //
    }

    public function getLatestCases() {
        //MOH data url github
        $url = 'https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_state.csv';

        //create curl
        $ch = curl_init();

        //set up the url
        curl_setopt($ch, CURLOPT_URL, $url);

        //return as string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //exec the curl
        $data = curl_exec($ch);

        //get the last line
         $lines = explode('\n',$data);
         $result= end($lines);
         $result = explode("\n",$result);
         $result_count = count($result);
        
         $state = array();
         
         for($i=0;$i<=15;$i++) {
             $state[$i] = $result[$result_count-($i+2)];
         }

         return($state);
    }

    public function getLatestDeath() {
        //MOH data url github
        $url = 'https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/deaths_state.csv';

        //create curl
        $ch = curl_init();

        //set up the url
        curl_setopt($ch, CURLOPT_URL, $url);

        //return as string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //exec the curl
        $data = curl_exec($ch);

        //get the last line
         $lines = explode('\n',$data);
         $result= end($lines);
         $result = explode("\n",$result);
         $result_count = count($result);
        
         $state = array();
         
         for($i=0;$i<=15;$i++) {
             $state[$i] = $result[$result_count-($i+2)];
         }

         return($state);
    }

    public function stateCase() {
        
        $state_case = $this->getLatestCases();
        $death_case = $this->getLatestDeath();

        $status = 'success';
        $message = 'Latest update Stored';
        $res = 204;
        $temp = '';

        for($i=0;$i<16;$i++) {
            $latestState = new LatestState;
            $case = explode(',',$state_case[$i]);
            $death = explode(',',$death_case[$i]);

            $latestState->date = $case[0];
            $latestState->state = $case[1];
            $latestState->cases_new = $case[3];
            $latestState->cases_recovered = $case[4];
            $latestState->death_new = $death[2];
            $saved = $latestState->save();

            $temp = $latestState.$temp;
            echo $temp;
            if(!$saved) {
                $status = 'error';
                $message = 'Data aborted';
                $res = 500;
                LatestState::abort(500, 'Error');
                break;
            }
        }

        $returnData = array(
            'status' => $status,
            'message' => $message
        );
        return response()->json($returnData, $res);
    }
}
