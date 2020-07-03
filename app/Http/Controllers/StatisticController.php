<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Criteria;
use App\Parfume;
use App\Statistic;

class StatisticController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $criterias = Criteria::all();
        $parfumes = Parfume::orderBy('number', 'asc')->get();

        return view('statistics.index', compact(['criterias', 'parfumes']));
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
        if ($request->parfume_id) {
            for ($i = 0; $i < count($request->parfume_id); $i++) {
                Statistic::where('parfume_id', $request->parfume_id[$i])->delete();
                for ($j = 0; $j < count($request->criteria_id[$i]); $j++) {
                    Statistic::create([
                        'parfume_id' => $request->parfume_id[$i],
                        'criteria_id' => $request->criteria_id[$i][$j],
                        'value' => $request->value[$i][$j]
                    ]);
                }
            }
        }

        $request->session()->flash('mess', 'Data berhasil diperbaharui');

        return redirect('statistics');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
