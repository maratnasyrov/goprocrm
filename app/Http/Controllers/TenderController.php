<?php

namespace App\Http\Controllers;

use App\Tender;
use App\Manager;
use App\Customer;
use App\Merchandise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\TenderHelper;

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
    public function show(Request $request, Tender $tender)
    {
        $customers = Customer::all();
        $tender_helper = new TenderHelper($tender);
        $managers = Manager::all();

        $t1 = $request->t1;
        $t2 = $request->t2;
        $t3 = $request->t3;

        if (($t2 == null) && ($t3 == null)) {
            $t1 = 'active';
        }

        ($tender->customer_id != null) ? $customer = Customer::find($tender->customer_id ) : $customer = null;

        return view('tenders.show', compact('tender', 'customers', 'customer', 'managers', 'tender_helper', 't1', 't2', 't3'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function edit(Tender $tender)
    {

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
        (sizeof($request->all()) == 3) ? $tender->update($request->only(['customer_id'])) : $tender->update($request->all());

        return redirect()->route('tender.show', $tender);
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
