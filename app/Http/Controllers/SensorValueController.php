<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Sensor;
use App\Models\SensorValue;
use Illuminate\Http\Request;

class SensorValueController extends Controller
{
    public function __construct() {
        $this->middleware(['auth.device']);
        $this->middleware(['auth:api'])->only(['indexForDevice']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Sensor $sensor)
    {
        //
        if ($request->expectsJson()) {
            return $this->apiIndex($request, $sensor);
        }
    }
    public function apiIndex(Request $request, Sensor $sensor) {
        $query = $sensor->sensorValues()
                        ->latest()
                        ->limit($request->input('limit', 12));
        
        if ($request->has('last_timestamp')) {
            $query = $query->where('recorded_at', '>', $request->input('last_timestamp'));
        }

        return $query->get();
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
    public function store(Request $request, Sensor $sensor)
    {
        //
        if (!$request->attributes->has('_device')) {
            return abort(422, 'Unknown device');
        }

        if (!$sensor->device()->is($request->attributes->get('_device'))) {
            return abort(401, 'Unauthorized');
        }

        $data = \array_merge($request->only(['recorded_at', ]), ['sensor_id' => $sensor->id, 'sensor_value' => $request->input('value')]);
        SensorValue::create($data);

        return 'OK';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SensorValue  $sensorValue
     * @return \Illuminate\Http\Response
     */
    public function show(SensorValue $sensorValue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SensorValue  $sensorValue
     * @return \Illuminate\Http\Response
     */
    public function edit(SensorValue $sensorValue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SensorValue  $sensorValue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SensorValue $sensorValue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SensorValue  $sensorValue
     * @return \Illuminate\Http\Response
     */
    public function destroy(SensorValue $sensorValue)
    {
        //
    }
}
