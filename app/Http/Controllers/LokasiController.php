<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use Illuminate\Support\Facades\View;

class LokasiController extends Controller
{
    public function searchKec (Request $request)
    {
        $kabval = $request->kabval;
        $matchlokasi = Location::where('kabkot',$kabval)->pluck('kecamatan','kecamatan');

        return view('location',compact('matchlokasi'));
    }

    public function getLocation (Request $request)
    {
        $kecval = $request->kecval;
        $kabval = $request->kabval;

        $col=Location::where('kabkot',$kabval)->where('kecamatan',$kecval)->first();

        $lat = $col->lat;
        $lng = $col->lng;

        return [$lat, $lng];
    }

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request){

        $lokasi = Location::orderBy('id')->paginate(8);
        return View::make('lokasi.index', ['lokasi' => $lokasi]);
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $lokasi = Location::findOrFail($id);

        return View::make('lokasi.edit', ['lokasi' => $lokasi]);
    }

    public function update($id, Request $request)
    {

        $requestData = $request->all();

        $lokasi = Location::findOrFail($id);
        $lokasi->update($requestData);

        return redirect('lokasi');
    }

    public function destroy($id)
    {

        Location::destroy($id);

        return redirect('lokasi');
    }
}
