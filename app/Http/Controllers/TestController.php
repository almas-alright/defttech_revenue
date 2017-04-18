<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
class TestController extends Controller
{
    public function index(){
    	return Carbon::parse('2016-06-08')->format('l');
    	//return view('welcome');
    }

    public function checkPost(Request $req){
    	
    }
}
