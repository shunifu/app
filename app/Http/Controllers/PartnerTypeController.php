<?php

namespace App\Http\Controllers;

use App\Models\PartnerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PartnerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $isBursar= Auth::user()->hasRole('bursar');
        $isAdminBursar= Auth::user()->hasRole('admin_bursar');
        if($isBursar OR $isAdminBursar){
            $partner_types=PartnerType::all();

            return view('accounting.partners.create-type', compact('partner_types'));


        }else{
            return view('errors.unauthorized');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $isBursar= Auth::user()->hasRole('bursar');
        $isAdminBursar= Auth::user()->hasRole('admin_bursar');

        if($isBursar OR $isAdminBursar){
            $partner_name=$request->partner_type;

            $check_accounts=PartnerType::where('type_name', $partner_name)->exists();
            if($check_accounts){
                flash()->overlay('Sorry. '.$partner_name.' '.'already exists in the system', 'Update Partner Type');
		return redirect()->back();
            }else{
                $validation=$request->validate([
                    'partner_type'=>'required'
                ]);
            
                PartnerType::create([
                    'type_name'=>$request->partner_type,
                ]);
        
                flash()->overlay('Success. You have successfully added the Partner Type', 'Add Partner Type');
        
                return redirect()->back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PartnerType  $partnerType
     * @return \Illuminate\Http\Response
     */
    public function show(PartnerType $partnerType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PartnerType  $partnerType
     * @return \Illuminate\Http\Response
     */
    public function edit(PartnerType $partnerType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PartnerType  $partnerType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PartnerType $partnerType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PartnerType  $partnerType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PartnerType $partnerType, $id)
    {
        $isBursar= Auth::user()->hasRole('bursar');
        $isAdminBursar= Auth::user()->hasRole('admin_bursar');
        if($isBursar OR $isAdminBursar){
        DB::table('partner_types')->where('id', $id)->delete();
		flash()->overlay('Success. You have deleted  partner type', 'Delete Partner');

		return redirect()->back();
    }else{
        return view('errors.unauthorized');
    }
    }
}
