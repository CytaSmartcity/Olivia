<?php

namespace App\Http\Controllers;

use App\Complain;
use App\Fine;
use Illuminate\Http\Request;

class FineController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $fines = Fine::all();
        $title = 'Fines';

        return \view('fines', \compact('fines', 'title'));
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
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Complain $complain
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Complain $complain)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Complain $complain
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Complain $complain)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Complain            $complain
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Complain $complain)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Complain $complain
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complain $complain)
    {
        //
    }
}
