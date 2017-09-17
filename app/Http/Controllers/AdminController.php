<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $admins = Admin::orderBy('id','desc')->paginate(8);
        return View::make('admin.index', ['admins' => $admins]);
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $admins = Admin::findOrFail($id);

        return View::make('admin.edit', ['admins' => $admins]);
    }

    public function update($id, Request $request)
    {

        $requestData = $request->all();

        $admins = Admin::findOrFail($id);
        $admins->update($requestData);

        return redirect('admin');
    }

    public function destroy($id)
    {

        Admin::destroy($id);

        return redirect('admin');
    }


}
