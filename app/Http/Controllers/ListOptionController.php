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
    	$listOption = ListOption::paginate($this->postPerPage);;
    	return view('listoption.index',compact('listOption'));
    }
}
