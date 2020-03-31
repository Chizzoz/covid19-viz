<?php

namespace App\Http\Controllers;

use App\CovidCase;
use Illuminate\Http\Request;

class CovidCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.app')->nest('right_sidebar', 'layouts.right_sidebar')->nest('content', 'covid_cases.pull_global');
    }

    /**
     * Pull global Covid-19 data from remote repository
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pullGlobaData(Request $request)
    {
        // Validation
        $this->validate($request, [
            'date' => 'required',
        ]);

        //$file_date = date('m-d-Y');
        
        $file = $request->date . '.csv';
        $filename = 'https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_daily_reports/'.$file;

        // The nested array to hold all the arrays
        $covid19_data = []; 
        
        // Open the file for reading
        if (($h = fopen("{$filename}", "r")) !== FALSE) 
        {
        // Each line in the file is converted into an individual array that we call $data
        // The items of the array are comma separated
        while (($data = fgetcsv($h, 1000, ",")) !== FALSE) 
        {
            // Each individual array is being pushed into the nested array
            $covid19_data[] = $data;		
        }
        
        // Close the file
        fclose($h);
        }

        try {
            $current_batch = CovidCase::orderBy('created_at', 'desc')->get()->first();
            $current_batch = $current_batch->batch;
            //$current_unique_source = CovidCase::orderBy('unique_source', 'asc')->get()->first()->pluck('unique_source');
        } catch(\Exception $e) {
            $current_batch = 0;
        }

        /* array to hold already stored items */
        $stored_cases = CovidCase::all()->pluck('unique_source')->toArray();
        
        $batch = $current_batch + 1;
        $covid19_data = array_slice($covid19_data, 1);
        foreach($covid19_data as $data_array) {
            $unique_source = \Str::slug($data_array[11] . $file, '-');
            if (\Arr::has($stored_cases, $unique_source)) {
                // Do nothing
            } else {
                $covid_case = new CovidCase;
                
                $covid_case->fill([
                    'batch' => $batch,
                    'fips' => $data_array[0] ?? null,
                    'admin' => $data_array[1] ?? null,
                    'province_state' => $data_array[2] ?? null,
                    'country_region' => $data_array[3],
                    'lastupdate' => $data_array[4],
                    'latitude' => $data_array[5] ?? null,
                    'longitude' => $data_array[6] ?? null,
                    'confirmed' => $data_array[7],
                    'deaths' => $data_array[8],
                    'recovered' => $data_array[9],
                    'active' => $data_array[10],
                    'combined_key' => $data_array[11],
                    'unique_source' => $unique_source,
                ]);
                $covid_case->save();

                /* array to hold already stored items */
                $stored_cases = CovidCase::all()->pluck('unique_source')->toArray();
            }
        }

        return redirect()->route('table');
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
     * @param  \App\CovidCase  $covid_case
     * @return \Illuminate\Http\Response
     */
    public function show(CovidCase $covid_case)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CovidCase  $covid_case
     * @return \Illuminate\Http\Response
     */
    public function edit(CovidCase $covid_case)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CovidCase  $covid_case
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CovidCase $covid_case)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CovidCase  $covid_case
     * @return \Illuminate\Http\Response
     */
    public function destroy(CovidCase $covid_case)
    {
        //
    }
}
