<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\PartnerType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


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


            $partner_type=PartnerType::all();
            $partners=DB::table('partners')
            ->join('partner_types','partner_types.id','=','partners.partner_type') 
            ->select('partners.id as partner_id', 'partners.partner_name', 'partner_location', 'partner_phone_contact', 'partner_email', 'partner_types.type_name')
            ->get();

         

            return view('accounting.partners.create-partner', compact('partner_type', 'partners'));


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
            $partner_name=$request->partner_name;
            $partner_type=$request->partner_type;
            $partner_contact=$request->partner_contact;
            $partner_email=$request->partner_email;
            $partner_physical_address=$request->partner_physical_address;

  
                Partner::create([
                    'partner_name'=>$partner_name,
                    'partner_type'=>$partner_type,
                    'partner_phone_contact'=>$partner_contact,
                    'partner_email'=>$partner_email,
                    'partner_location'=>$partner_physical_address,

                ]);

                flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have added the Partner', 'Add Partner');
                return redirect()->back();
    }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner, $id)
    {
      $isBursar= Auth::user()->hasRole('bursar');
      $isAdminBursar= Auth::user()->hasRole('admin_bursar');
      if($isBursar OR $isAdminBursar){
       //check if partner isalready used in petty cash or fees
       //if true cant


      DB::table('partners')->where('id', $id)->delete();
  flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have deleted partner', 'Delete Partner');

  return redirect()->back();
  }else{
      return view('errors.unauthorized');
  }
    }
}
