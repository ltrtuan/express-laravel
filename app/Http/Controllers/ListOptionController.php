<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ListOption as ListOption;


class ListOptionController extends Controller
{
    public $postPerPage = 10;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$listOption = ListOption::where('parent_id', 0)->paginate($this->postPerPage);
    	return view('listoption.index',compact('listOption'));
    }

    public function create(ListOption $optionParent)
    {       
        $optionChild = ListOption::where('parent_id', $optionParent->id)->get();        
        return view('listoption.create',compact('optionParent','optionChild'));
    }

    public function save(ListOption $optionParent, Request $request)
    {       
        ListOption::create($request->all());
        $request->session()->flash('alert-success', trans('users.create_user_success'));  
        return redirect()->route('create_list_option_child_path', $optionParent->id);
    }
} 
