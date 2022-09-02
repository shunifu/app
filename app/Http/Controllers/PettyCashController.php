<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Partner;
use App\Models\PettyCash;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\AcademicSession;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class PettyCashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $isBursar= Auth::user()->hasRole('bursar');
        $isAdminBursar= Auth::user()->hasRole('admin_bursar');
        $isAdmin= Auth::user()->hasRole('admin_teacher');
        if($isBursar OR $isAdminBursar OR $isAdmin){

            $pettycash_data = DB::table('petty_cashes')
            ->join('accounts', 'accounts.id', '=', 'petty_cashes.account')
            ->join('partners', 'partners.id', '=', 'petty_cashes.partner')
            ->select('petty_cashes.id', 'petty_cashes.description as item', 'accounts.account_name', 'partner_name', 'petty_cashes.amount', 'petty_cashes.date', 'petty_cashes.financial_year')
            ->get();

            return view('accounting.petty-cash.manage', compact('pettycash_data'));


        }
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


            $accounts=Account::all();
            $partners=Partner::all();

            return view('accounting.petty-cash.index', compact('accounts', 'partners'));


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
            $partner=$request->partner;
            $account=$request->account;
            $date=$request->date;
            $item=$request->item;
            $reference=$request->reference;
            $amount=$request->amount;

        
            $financial_year= new Carbon($date);  
            $fy=$financial_year->year;

            $current_session=AcademicSession::where('academic_session',$fy)->get();
            
            $current_fy=$current_session[0]->id;

            $refExists=PettyCash::where('ref',$reference)->exists();

            if($refExists){

                flash()->overlay('<i class="fas fa-check-circle text-success"></i> Sorry. That reference number exists in the database', 'Add Petty Cash');
                return redirect()->back();

            }else{

                PettyCash::create([
                   
                    'account'=>$account,
                    'partner'=>$partner,
                    'ref'=>$reference,
                    'description'=>$item,
                    'amount'=>$amount,
                    'date'=>$date,
                    'financial_year'=>$current_fy

                ]);

                flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have added Petty Cash', 'Add Petty Cash');
                return redirect()->back();

            }

  
               


              
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PettyCash  $pettyCash
     * @return \Illuminate\Http\Response
     */
    public function show(PettyCash $pettyCash)
    {
        //
    }


    public function report_index(){

        $sessions=AcademicSession::all();

        return view('accounting.petty-cash.report.index', compact('sessions'));

    }

    public function report( Request $request){

      //  dd($request->all());

        $month = date('m');
   


       //if consolidated=it means it is a summation of the months payments

       if($request->report_type=="consolidated"){

       }else if($request->report_type=="transactional"){

$getTransactionsWithParameter = DB::table('petty_cashes')                                 
                             ->join('partners','partners.id','=','petty_cashes.partner') 
                             ->join('accounts','accounts.id','=','petty_cashes.account') 
                             ->join('academic_sessions','academic_sessions.id','=','petty_cashes.financial_year') 
                             ->select('petty_cashes.id','accounts.account_name', 'partners.partner_name','petty_cashes.amount')
                             ->whereMonth('date', '=', $month)
                             ->where('financial_year','=',$request->financial_year)
                             ->get();

$getTransactionsWithoutParameter = DB::table('petty_cashes')                                 
                             ->join('partners','partners.id','=','petty_cashes.partner') 
                             ->join('accounts','accounts.id','=','petty_cashes.account') 
                             ->join('academic_sessions','academic_sessions.id','=','petty_cashes.financial_year') 
                             ->select('petty_cashes.id','accounts.account_name', 'partners.partner_name','petty_cashes.amount')
                             ->where('financial_year','=',$request->financial_year)
                             ->get();

                             if($request->month=="null"){
                                return view('accounting.petty-cash.report.view', compact('getTransactionsWithoutParameter'));
                             }else{
                                return view('accounting.petty-cash.report.view', compact('getTransactionsWithParameter')); 
                             }

                         
     


        

       }



       //if transactional it means the display of transactions of that selected period 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PettyCash  $pettyCash
     * @return \Illuminate\Http\Response
     */
    public function edit(PettyCash $pettyCash)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PettyCash  $pettyCash
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PettyCash $pettyCash)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PettyCash  $pettyCash
     * @return \Illuminate\Http\Response
     */
    public function destroy(PettyCash $pettyCash)
    {
        //
    }
}
