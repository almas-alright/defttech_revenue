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
    	
    	$tr;
        foreach ($revenues as $revenue) {
            
            $tr[]= array(
                'id'=>$revenue->id,              
                'entry_for'=>
                Carbon::createFromFormat('Y-m-d', $revenue->entry_for)->format('d-M-y'),
                'date'=> $revenue->entry_for,
                'desktop_spend'=> $revenue->desktop_spend,
                'desktop_mod'=> $revenue->desktop_mod,
                'mobile_spend'=> $revenue->mobile_spend,
                'mobile_mod'=> $revenue->mobile_mod,                
                );
        }

    	return $tr;

    	
    }
}
