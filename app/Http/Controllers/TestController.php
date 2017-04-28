<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Revenue;
class TestController extends Controller
{
    public function index(){
    	//return Carbon::parse('2016-06-08')->format('l');
    	return view('revenue.chart');
    }

    public function checkPost(Request $req){
    	
    }

    public function fact(){
    	$revenues = collect(Revenue::orderByDesc('entry_for')->get());
    	
    	// $size = count($revenues);
    	// $collection = array();
    	// for($i = 0; $i <= $size - 1; $i++){
    		
    	// 		$collection['label'][] = $revenues[$i]['entry_for'];
    	// 		$collection['ds'][] = $revenues[$i]['desktop_spend'];
    		
    	// }

    	return $revenues;

    	
    }
}
