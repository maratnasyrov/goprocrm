<?php

namespace App\Http\Controllers;

use App\Merchandise;
use App\Tender;
use Illuminate\Http\Request;

class MerchandiseController extends Controller
{
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
    public function store(Merchandise $merchandise, Request $request)
    {
        $merchandise->create($request->all());

        $tender = Tender::find($request->tender_id);
        return redirect()->route('tender.show', $tender);
    }

    public function createmerch_ajax(Request $request)
    {
        $merchandise = Merchandise::create($request->all());

        return response()->json(['result' => $merchandise]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Merchandise  $merchandise
     * @return \Illuminate\Http\Response
     */
    public function show(Merchandise $merchandise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Merchandise  $merchandise
     * @return \Illuminate\Http\Response
     */
    public function edit(Merchandise $merchandise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Merchandise  $merchandise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merchandise $merchandise)
    {
        $merchandise->update($request->all());
        $tender = Tender::find($merchandise->tender_id);
        return redirect()->route('tender.show', $tender);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Merchandise  $merchandise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merchandise $merchandise)
    {
        //
    }
}
