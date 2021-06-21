<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function __construct() {
        $this->middleware(['auth.device'])->except('authenticateDevice');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Device $device)
    {
        //
        if ($request->expectsJson()) {
            return $this->apiShow($request, $device);
        }

        return view('devices.show', [
            'device' => $device,
        ]);
    }
    public function apiShow(Request $request, Device $device) {
        return Device::with([
            'sensors',
            'outputs',
        ])->where('id', $device->id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        //
    }

    public function authenticateDevice(Request $request) {
        $request->validate([
            'serial_number' => ['required', 'uuid', ],
            'pin' => ['required', 'string:8']
        ]);

        $device = Device::where('serial_number', $request->input('serial_number'))
                        ->where('pin', $request->input('pin'))
                        ->first();
        
        if (!$device) {
            return abort(422, 'Unknown device');
        }

        $device->refreshAuthenticationToken();

        return $device;
    }
}
