<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PointsEstimation;
use Illuminate\Http\Request;

class PointsEstimationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.points-estimation');
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
     * @param  \App\Models\PointsEstimation  $pointsEstimation
     * @return \Illuminate\Http\Response
     */
    public function show(PointsEstimation $pointsEstimation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PointsEstimation  $pointsEstimation
     * @return \Illuminate\Http\Response
     */
    public function edit(PointsEstimation $pointsEstimation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PointsEstimation  $pointsEstimation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PointsEstimation $pointsEstimation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PointsEstimation  $pointsEstimation
     * @return \Illuminate\Http\Response
     */
    public function destroy(PointsEstimation $pointsEstimation)
    {
        //
    }
}
