<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ListOption as ListOption;
use App\Http\Requests\UpdateOptionChildRequest;
use App\Http\Requests\CreateOptionChildRequest;

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

    public function save(ListOption $optionParent, CreateOptionChildRequest $request)
    {       
        $newOption = new ListOption;
        $newOption->name = $request->name_option;
        $newOption->save();

        if($newOption->id > 0)    
    		$request->session()->flash('alert-success', trans('general.create_success',['field' => trans('option.option')]));
    	else
    		$request->session()->flash('alert-danger', trans('general.create_fail',['field' => trans('option.option')]));
     
        return redirect()->route('create_list_option_child_path', $optionParent->id);
    }

    public function delete(ListOption $optionParent, Request $request){
    	$listIdOptionChild = $request->input('id_option');
    	$result = ListOption::destroy($listIdOptionChild);
    	if($result > 0)    
    		$request->session()->flash('alert-success', trans('general.delete_success',['field' => trans('option.option')]));
    	else
    		$request->session()->flash('alert-danger', trans('general.delete_fail',['field' => trans('option.option')]));
    	return redirect()->route('create_list_option_child_path', $optionParent->id);
    }

    public function update(ListOption $optionParent, UpdateOptionChildRequest $request){
    	$listOptionChild = $request->input('name_option');    	
    	$result = false;
    	if(count($listOptionChild) > 0)
    	{
    		foreach ($listOptionChild as $idOption => $nameOption) {
	           $optionExist = ListOption::whereId($idOption)->first();
	           if($optionExist)
	           {	                
	                $optionExist->name = $nameOption;
	                $result = $optionExist->save();	              
	           }
	        }
    	}
    	
    	if($result)    
    		$request->session()->flash('alert-success', trans('general.update_success',['field' => trans('option.option')]));
    	else
    		$request->session()->flash('alert-danger', trans('general.update_fail',['field' => trans('option.option')]));
    	return redirect()->route('create_list_option_child_path', $optionParent->id);
    }
} 
