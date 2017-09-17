<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){

        $client = User::orderBy('id','desc')->paginate(8);
        return View::make('client.index', ['client' => $client]);
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $client = User::findOrFail($id);

        return View::make('client.edit', ['client' => $client]);
    }

    public function update($id, Request $request)
    {

        $requestData = $request->all();

        $client = User::findOrFail($id);
        $client->update($requestData);

        return redirect('client');
    }

    public function destroy($id)
    {

        User::destroy($id);

        return redirect('client');
    }
}
