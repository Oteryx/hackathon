<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Spot;
use Illuminate\Http\Request;

class SpotsController extends Controller
{


    /**
     * index spots.
     *
     * @param \Illuminate\Http\Request $request
     * @param Spot  $Spot
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Spot::all();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Spot  $Spot
     * @return \Illuminate\Http\Response
     */
    public function storeSpot(Request $request)
    {
        $Spot = new Spot();
        $Spot->name = $request->name;
        $Spot->address = $request->address;
        $Spot->save();

        return "okkk";
    }

}
