<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parfume;

class ParfumeController extends Controller
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
            $parfumes = Parfume::whereRaw('name like "%' . $request->q . '%"')->orderBy('id', 'desc')->paginate(10);
        }
        else {
            $parfumes = Parfume::orderBy('id', 'desc')->paginate(10);
        }
        
        $request->flash();

        return view('parfumes.index', compact(['parfumes']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parfumes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Parfume::create(['name' => $request->name]);

        $request->session()->flash('mess', 'Data berhasil disimpan');

        return redirect('parfumes');
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
        $parfume = Parfume::find($id);

        return view('parfumes.edit', compact(['parfume']));
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
        $parfume = Parfume::find($id);
        $parfume->update(['name' => $request->name]);

        $request->session()->flash('mess', 'Data berhasil diperbaharui');

        return redirect('parfumes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Parfume::destroy($id);

        $request->session()->flash('mess', 'Data berhasil dihapus');

        return redirect('parfumes');
    }
}
