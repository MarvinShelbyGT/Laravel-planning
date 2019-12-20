<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Planning;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $employees = Employee::where('user_id', '=', Auth::user()->id)->get();
        $plannings = Planning::all();
        return view('planning.index', compact('employees', 'plannings'));
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
     * @return int
     */
    public function store(Request $request)
    {
        $planning = new Planning();
        $planning->date = $request->get('date');
        $planning->date_end = $request->get('date_end');
        $planning->employee()->associate($request->get('employee_id'));
        $planning->save();
        return 0;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function show($id)
    {
        $employees = Employee::all();
        $planning = Planning::find($id);
        return view('planning.show', compact('planning','employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $planning = Planning::find($id);
        $planning->date = $request->get('date');
        $planning->date_end = $request->get('date_end');
        $planning->employee()->associate($request->get('employee_id'));
        $planning->save();

        return Redirect::to("/planning")->withSuccess('Planning mis à jour');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
