<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class SuperAdmin_dashboard extends Controller
{
    public function home ()
    {
        return view('superadmin.home');
    }
    public function add ()
    
    {
        $categories = Category::all();
        return view('superadmin.add',compact('categories'));
    }

    public function add_category (Request $request)
    {
        $insertRecord = new Category;
        $insertRecord->name = trim($request->name);
        $insertRecord->save();
        return redirect()->back()->with('success', "Business Record Successfully Add");
    }

    public function delete_category ($id)
    {
        $deleteRecord =  Category::find($id);
        $deleteRecord->delete();
        return redirect()->back()->with('success', "Business Record Successfully Add");
    }

    public function list ()
    {
        return view('superadmin.list');
    }

}
