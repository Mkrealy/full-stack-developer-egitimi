<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index ()
    {
        return view('admin.tag_list');
    }
    public function create (){
        return view('admin.tag_add');
    }
    public function store(Request $request){
        
        dd($request->all());
    }
}
