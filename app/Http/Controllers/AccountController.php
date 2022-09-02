<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
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


    public function auth() {
        $isBursar= Auth::user()->hasRole('bursar');
        $isAdminBursar= Auth::user()->hasRole('admin_bursar');
    }

  
    public function create()
    {
        $isBursar= Auth::user()->hasRole('bursar');
        $isAdminBursar= Auth::user()->hasRole('admin_bursar');
        if($isBursar OR $isAdminBursar){
            $accounts=Account::all();

            return view('accounting.fees-management.accounts.index', compact('accounts'));


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
            $account_name=$request->account_name;

            $check_accounts=Account::where('account_name', $account_name)->exists();
            if($check_accounts){
                flash()->overlay('Sorry. '.$account_name.' '.'already exists in the system', 'Update Assessement');
		return redirect()->back();
            }else{
                $validation=$request->validate([
                    'account_name'=>'required'
                ]);
            
                Account::create([
                    'account_name'=>$request->account_name,
                ]);
        
                flash()->overlay('Success. You have successfully added the account', 'Add Account');
        
                return redirect()->back();
            }
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account, $id)
    {
        $account=Account::where('id', $id)->first();
        return view('accounting.fees-management.accounts.edit-account', compact('account'));
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $id = $request->account_id;

       

		$account_data = Account::find($id);
		$account_data->account_name = $request->account_name;
		$account_data->save();
        flash()->overlay('Success. You have successfully updated'.' '.$request->account_name, 'Update Account');
        
        return redirect('/accounting/fees-management/accounts/add');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account, $id)
    {
        $isBursar= Auth::user()->hasRole('bursar');
        $isAdminBursar= Auth::user()->hasRole('admin_bursar');
        if($isBursar OR $isAdminBursar){
        DB::table('accounts')->where('id', $id)->delete();
		flash()->overlay('Success. You have deleted  account', 'Delete Account');

		return redirect()->back();
    }else{
        return view('errors.unauthorized');
    }
}
}
