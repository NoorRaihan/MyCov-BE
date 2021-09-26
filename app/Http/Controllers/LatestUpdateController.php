<?php

namespace App\Http\Controllers;

use App\Models\LatestUpdate;
use Illuminate\Http\Request;

class LatestUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        LatestUpdate::all();
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
     * @param  \App\Models\LatestUpdate  $latestUpdate
     * @return \Illuminate\Http\Response
     */
    public function show(LatestUpdate $latestUpdate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LatestUpdate  $latestUpdate
     * @return \Illuminate\Http\Response
     */
    public function edit(LatestUpdate $latestUpdate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LatestUpdate  $latestUpdate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LatestUpdate $latestUpdate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LatestUpdate  $latestUpdate
     * @return \Illuminate\Http\Response
     */
    public function destroy(LatestUpdate $latestUpdate)
    {
        //
    }

    public function getLatestCase() {
        //MOH data url github
        $url = 'https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_malaysia.csv';

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

        //explode it by ,
        return(explode(",",$result[$result_count-2]));
    }

    public function getLatestDeath() {
         //MOH data url github
         $url = 'https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/deaths_malaysia.csv';

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
 
         //explode it by ,
         return(explode(",",$result[$result_count-2]));
    }

    public function latest() 
    {

        //explode it by ,
        $case = $this->getLatestCase();
        $death = $this->getLatestDeath();

        //check for the date in db
        $all = LatestUpdate::all();

        if($all->isEmpty()) {
            //inserting into db
            $update = LatestUpdate::create([
                'date'              => $case[0],
                'cases_new'         => (int)$case[1],
                'cases_recovered'   => (int)$case[3],
                'death_new'         => (int)$death[1]
            ]);

        } else {
            $update = LatestUpdate::select('date')->orderBy('id','desc')->first();
            //check if the date are same
            if($update->date ==$case[0]) {
                //returning the null
                null;
            } else {
                //update the table
                $update = new LatestUpdate;
                $update->date =$case[0];
                $update->cases_new = (int)$case[1];
                $update->cases_recovered = (int)$case[3];
                $update->death_new = (int)$death[1];
                $update->save();
            }

        }

        $latest_update = LatestUpdate::all();
        return response()->json($latest_update,200);
    }
}
