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
        $revenue = Revenue::find($id);
        return view('revenue.edit', compact('revenue'));
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
        $this->validate($request,
            [
            'entry_for' => 'required',
            'desktop_spend' => 'required',
            'desktop_mod' => 'required',
            'mobile_spend' => 'required',
            'mobile_mod' => 'required',
            ]);

        $revenue = Revenue::find($id);
        $revenue->user_id = $request->input('user_id');
        $revenue->entry_for = $request->input('entry_for');
        $revenue->desktop_spend = $request->input('desktop_spend');
        $revenue->desktop_mod = $request->input('desktop_mod');
        $revenue->mobile_spend = $request->input('mobile_spend');
        $revenue->mobile_mod = $request->input('mobile_mod');
        $revenue->status = true;        

        $revenue->save();
        
        return redirect('revenue');    
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

    public function status($type){
        return view('revenue.status', compact('type'));
    }

    public function showall(){
        $revenues = Revenue::orderByDesc('entry_for')->get();        
        $tr;
        foreach ($revenues as $revenue) {
            
            $tr[]= array(
                'id'=>$revenue->id,              
                'dayname'=> Carbon::parse($revenue->entry_for)->format('l'),
                'date'=> Carbon::createFromFormat('Y-m-d', $revenue->entry_for)->format('d-M-y'),
                'desktop_spend'=> $revenue->desktop_spend,
                'desktop_mod'=> $revenue->desktop_mod,
                'mobile_spend'=> $revenue->mobile_spend,
                'mobile_mod'=> $revenue->mobile_mod,                
                );
        }
        //return $tr;

         return Datatables::of($tr)
         ->addIndexColumn()
         ->addColumn('operations','<a class="btn btn-xs btn-info" href="{{ route( \'revenue.edit\', [$id]) }}"><i class="fa fa-pencil-square-o"></i></a>
                    <a class="btn btn-xs btn-danger" href="{{ route( \'revenue.destroy\', [$id]) }}"><i class="fa fa-trash-o"></i></a>')
         ->rawColumns(['operations'])
         ->make(true);
    }

    public function showRange($start, $end){
        $sa = Carbon::createFromFormat('Y-m-d',$start)->toDateString();
        $ea = Carbon::createFromFormat('Y-m-d',$end)->toDateString();
        $revenues = Revenue::whereBetween('entry_for', [$sa, $ea])->orderByDesc('entry_for')->get();
        $tr;
        if(count($revenues) > 0){
            foreach ($revenues as $revenue) {            
                $tr[]= array(
                    'id'=>$revenue->id,               
                    'dayname'=> Carbon::parse($revenue->entry_for)->format('l'),
                    'date'=> Carbon::createFromFormat('Y-m-d', $revenue->entry_for)->format('d-M-y'),
                    'desktop_spend'=> $revenue->desktop_spend,
                    'desktop_mod'=> $revenue->desktop_mod,
                    'mobile_spend'=> $revenue->mobile_spend,
                    'mobile_mod'=> $revenue->mobile_mod,                
                    );
            } 
            } else{
            $tr = [];
            }      
        
         return Datatables::of($tr)
         ->addIndexColumn()
         ->addColumn('operations','<a class="btn btn-xs btn-info" href="{{ route( \'revenue.edit\', [$id]) }}"><i class="fa fa-pencil-square-o"></i></a>
                    <a class="btn btn-xs btn-danger" href="{{ route( \'revenue.destroy\', [$id]) }}"><i class="fa fa-trash-o"></i></a>')
         ->rawColumns(['operations'])
         ->make(true);
     
    }

}
