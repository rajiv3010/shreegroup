<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Banking;
use DB;
use Validator;

class BankingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bankings = Banking::orderby('id','ASC')->get();
        return view('admin.banking.list',compact('bankings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banking.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Banking::create([

        'company_name'=>$request->company_name,
        'bank_name'=>$request->bank_name,
        'account_number'=>$request->account_number,
        'branch_name'=>$request->branch_name,
        'ifsc'=>$request->ifsc
        
      ]);

        Session::flash('message','Bank added');
      return redirect('/admin/banking');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.banking.list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banking = Banking::where('id', $id)->first();

           return view('admin.banking.edit', compact('banking', 'id'));
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
        
        $bankings = Banking::find($id);
       $bankings->company_name =$request->company_name;
       $bankings->bank_name =$request->bank_name;
       $bankings->account_number =$request->account_number;
       $bankings->branch_name =$request->branch_name;
       $bankings->ifsc =$request->ifsc;
        
        $bankings->save();
        Session::flash('message','Bank Updated');
          return redirect('/admin/banking');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bankings = Banking::find($id)->delete();
        

        return redirect('/admin/banking');
    }
}
