<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use CreateConnection;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = Auth::user();
        $userConnection = '';
        if($currentUser->role_id == 2){
            //CreateConnection::setupConnection();
            CreateConnection::createTable(CreateConnection::getNameDatabaseUser($currentUser->id));
        }
        
        return view('home.index',compact('currentUser','userConnection'));
    }
}
