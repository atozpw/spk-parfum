<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Criteria;

class CriteriaController extends Controller
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
        if ($request->q) {
            $criterias = Criteria::whereRaw('name like "%' . $request->q . '%"')->orderBy('id', 'desc')->paginate(10);
        }
        else {
            $criterias = Criteria::orderBy('id', 'desc')->paginate(10);
        }
        
        $request->flash();

        return view('criterias.index', compact(['criterias']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('criterias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Criteria::create([
            'code' => $request->code,
            'name' => $request->name,
            'attribute' => $request->attribute,
            'weight' => $request->weight
        ]);
        
        $request->session()->flash('mess', 'Data berhasil disimpan');

        return redirect('criterias');
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
        $criteria = Criteria::find($id);
        return view('criterias.edit', compact(['criteria']));
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
        $criteria = Criteria::find($id);
        $criteria->update([
            'code' => $request->code,
            'name' => $request->name,
            'attribute' => $request->attribute,
            'weight' => $request->weight
        ]);
        
        $request->session()->flash('mess', 'Data berhasil diperbaharui');

        return redirect('criterias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Criteria::destroy($id);

        $request->session()->flash('mess', 'Data berhasil dihapus');

        return redirect('criterias');
    }
}
