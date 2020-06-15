<?php

namespace App\Http\Controllers;

use App\EsnbcSubset;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Generator;

class EsnbcSubsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // print_r(EsnbcSubset::paginate(5));exit;
        // return view('esnbc_subsets.index')->with('esnbc_subsets',EsnbcSubset::first());
        $esnbc_subsets = EsnbcSubset::paginate(5);
        return view('esnbc-subsets.index')->with('esnbc_subsets',$esnbc_subsets);
    }

    /**
     * Show qrcode
     *
     * @param  \App\EsnbcSubset  $esnbcSubset
     * @return \Illuminate\Http\Response
     */
    public function qrcode(EsnbcSubset $esnbc_subset)
    {
        $qrcode = new Generator;
        // $qrcode->format('png');
        return $qrcode->size(250)->generate('Make a qrcode without Laravel!');
        // print_r($esnbc_subset);exit;
        // return QrCode::size(500)->generate('W3Adda Laravel Tutorial');
        // return view('esnbc-subsets.edit')->with(compact('esnbc_subset'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $esnbc_subset = new EsnbcSubset();

        return view('esnbc-subsets.create')->with(compact('esnbc_subset'));    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        EsnbcSubset::create($request->all());

        return redirect(route('esnbc-subset-index'))->with('message','esnbc-subset successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EsnbcSubset  $esnbcSubset
     * @return \Illuminate\Http\Response
     */
    public function show(EsnbcSubset $esnbc_subset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EsnbcSubset  $esnbcSubset
     * @return \Illuminate\Http\Response
     */
    public function edit(EsnbcSubset $esnbc_subset)
    {
        // print_r($esnbcSubset);exit;
        return view('esnbc-subsets.edit')->with(compact('esnbc_subset'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EsnbcSubset  $esnbcSubset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EsnbcSubset $esnbc_subset)
    {
        // print_r($esnbcSubset);exit;
        $esnbc_subset->update($request->all());
        return redirect(route('esnbc-subset-index'))->with('message','esnbc-subset successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EsnbcSubset  $esnbcSubset
     * @return \Illuminate\Http\Response
     */
    public function destroy(EsnbcSubset $esnbc_subset)
    {
        // print_r($esnbcSubset->update_type);exit();
        // $esnbcSubset->delete();
        $esnbc_subset->update_type = "Delete";
        $esnbc_subset->save();

        return redirect(route('esnbc-subset-index'))->with('message','esnbc-subset successfully removed. But not updated to fabric net yet(status: pending).');
    }
}