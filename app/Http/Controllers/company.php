<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\addcompany;
use Illuminate\Support\Facades\Cache;
class company extends Controller
{
    public function index(){
        return view('form');
    }
    public function store(Request $request)
    {
        $form = new addcompany();

        $form->name = $request->input('name');
        $form->image = $request->input('image');
        $form->address = $request->input('address');
        $form->contact = $request->input('contact');
        $form->website = $request->input('website');
        $form->email = $request->input('email');

        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getclientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/form/',$filename);
            $form->image = $filename;
        }
        else{
            return $request;
            $form->image = '';
        }
        $form->save();
        return view('form')->with('form',$form);
    }
}
