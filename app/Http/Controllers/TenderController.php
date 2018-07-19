<?php

namespace App\Http\Controllers;

use App\Tender;
use App\Manager;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managers = Manager::all();

        return view('tenders.index', compact('managers'), [
            'tenders' => Tender::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $managers = Manager::all();

        return view('tenders.create', compact('managers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tender = Tender::create($request->all());

        if($request->input['managers']) {
            $tender->managers()->attach($request->input['managers']);
        }

        return redirect()->route('tender.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function show(Tender $tender)
    {
        $customers = Customer::all();
        return view('tenders.show', compact('tender', 'customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function edit(Tender $tender)
    {
        $customers = Customer::all();
        $managers = Manager::all();
        return view('tenders.edit', compact('tender', 'managers', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tender $tender)
    {
        $tender->update($request->all());

        return redirect()->route('tender.show', [$tender]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tender $tender)
    {
        $tender->delete();

        return redirect()->route('tender.index');
    }
}
