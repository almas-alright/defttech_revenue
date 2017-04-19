<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use App\Revenue;
use Carbon\Carbon;
class RevenueController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('revenue.showall');
        // return Revenue::whereBetween('entry_for', ['2017-04-02', '2017-04-08'])->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('revenue.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $revenue = new Revenue;
        $revenue->user_id = $request->input('user_id');
        $revenue->entry_for = $request->input('entry_for');
        $revenue->desktop_spend = $request->input('desktop_spend');
        $revenue->desktop_mod = $request->input('desktop_mod');
        $revenue->mobile_spend = $request->input('mobile_spend');
        $revenue->mobile_mod = $request->input('mobile_mod');
        $revenue->status = true;

        $this->validate($request,
            [
            'entry_for' => 'required',
            'desktop_spend' => 'required',
            'desktop_mod' => 'required',
            'mobile_spend' => 'required',
            'mobile_mod' => 'required',
            ]);

        $revenue->save();
        
        return redirect('revenue');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showall(){
        $revenues = Revenue::all();
        $ser = 1;
        $tr;
        foreach ($revenues as $revenue) {
            
            $tr[]= array(
                'ser' => $ser ++,
                'dayname'=> Carbon::parse($revenue->entry_for)->format('l'),
                'date'=> $revenue->entry_for,
                'desktop_spend'=> $revenue->desktop_spend,
                'desktop_mod'=> $revenue->desktop_mod,
                'mobile_spend'=> $revenue->mobile_spend,
                'mobile_mod'=> $revenue->mobile_mod,                
                );
        }
        //return $tr;

         return Datatables::of($tr)->make(true);
    }

}
