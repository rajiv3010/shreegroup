<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\RegistryForm;
use App\PropertyAllotment;
use DB;
use File;
use Auth;
use Paginate;
use Session;
use DateTime;
use \Carbon\Carbon;
class RegistryFormController extends Controller
{
     public function filled($id)
    {
      $filledForm = RegistryForm::where('property_allotment_id',$id)->first();
      
      return view('users/registryForm/filled',compact('filledForm'));
    }

    public function create($id)
    {
        $userProperty = PropertyAllotment::where('id',$id)->first();

      
        return view('users/registryForm/add',compact('userProperty'));
      
    }

    public function edit($id)
    {
        $filledForm =  RegistryForm::where('id',$id)->where('user_key',auth::user()->user_key)->first();
        return view('users/registryForm/edit',compact('filledForm'));
        
    }

    public function update(Request $request)
    {   

         $folderPath = 'assets/user/'. Auth::user()->id.'/documents';
         $RegistryForm = RegistryForm::find($request->id);
          $RegistryForm->user_key =     $request->user_key;
          $RegistryForm->property_allotment_id =     $request->property_allotment_id;
          $RegistryForm->purchasers_name =     $request->purchasers_name;
          $RegistryForm->fathers_name =     $request->fathers_name;
          $RegistryForm->address =     $request->address;
          $RegistryForm->state =     $request->state;
          $RegistryForm->pincode =     $request->pincode;
          $RegistryForm->dob =     $request->dob;
          $RegistryForm->age =     $request->age;
          $RegistryForm->phone =     $request->phone;
          $RegistryForm->alt_phone =     $request->alt_phone;
          $RegistryForm->aadhaar_number =     $request->aadhaar_number;
          $RegistryForm->pan =     $request->pan;
          $RegistryForm->occupation =     $request->occupation;
          $RegistryForm->religion =     $request->religion;
          $RegistryForm->customer_bank_name =     $request->customer_bank_name;
          $RegistryForm->company_bank_name =     $request->company_bank_name;
          $RegistryForm->paid_amount =     $request->paid_amount;
          $RegistryForm->cheque_utr_no =     $request->cheque_utr_no;
          $RegistryForm->date_of_payment =     $request->date_of_payment;
          $RegistryForm->pay_mode =     $request->pay_mode;
          $RegistryForm->project_name =     $request->project_name;
          $RegistryForm->phase_no =     $request->phase_no;
          $RegistryForm->unit_no =     $request->unit_no;
          $RegistryForm->plot_1 =     $request->plot_1;
          $RegistryForm->plot_2 =     $request->plot_2;
          $RegistryForm->plot_size =     $request->plot_size;
          $RegistryForm->rate =     $request->rate;
          $RegistryForm->tnc_checked =     $request->tnc_checked;
          $RegistryForm->status =     0;

        if($request->hasFile('transaction_proof')){
            $file=$request->file('transaction_proof');
            $transaction_proof = Auth::user()->id.'_'.rand().'_'.$file->getClientOriginalName();
            $file->move($folderPath, $transaction_proof);
            $RegistryForm->transaction_proof  =  $transaction_proof;
        }

        if ($request->hasFile('pan_documents')) {
            $file = $request->file('pan_documents');
            $pan_documents = rand() . $file->getClientOriginalName();
            $file->move($folderPath, $pan_documents);
            $RegistryForm->pan_documents = $pan_documents;
        }
        if ($request->hasFile('adhaar_front')) {
            $file = $request->file('adhaar_front');
            $adhaar_front = rand() . $file->getClientOriginalName();
            $file->move($folderPath, $adhaar_front);
            $RegistryForm->adhaar_front = $adhaar_front;
        }
        if ($request->hasFile('adhaar_back')) {
            $file = $request->file('adhaar_back');
            $adhaar_back = rand() . $file->getClientOriginalName();
            $file->move($folderPath, $adhaar_back);
            $RegistryForm->adhaar_back = $adhaar_back;
        }


        $RegistryForm->save();            
          
      Session::flash('message','Registry Form Updated');
      return redirect('/registry-form/filled/'.$request->property_allotment_id);
     }


    public function store(Request $request)
    {


        $folderPath = 'assets/user/'. Auth::user()->id.'/documents';
        if ($request->hasFile('transaction_proof')){
            $file=$request->file('transaction_proof');
            $transaction_proof = Auth::user()->id.'_'.rand().'_'.$file->getClientOriginalName();
            $file->move($folderPath, $transaction_proof);
        }
        if ($request->hasFile('pan_documents')) {
            $file = $request->file('pan_documents');
            $pan_documents = rand() . $file->getClientOriginalName();
            $file->move($folderPath, $pan_documents);
            }
        if ($request->hasFile('adhaar_front')) {
            $file = $request->file('adhaar_front');
            $adhaar_front = rand() . $file->getClientOriginalName();
            $file->move($folderPath, $adhaar_front);
           
        }
        if ($request->hasFile('adhaar_back')) {
            $file = $request->file('adhaar_back');
            $adhaar_back = rand() . $file->getClientOriginalName();
            $file->move($folderPath, $adhaar_back);
            
        }

         RegistryForm::create([

          'user_key'=>$request->user_key,
          'property_allotment_id'=>$request->property_allotment_id,
          'purchasers_name'=>$request->purchasers_name,
          'fathers_name'=>$request->fathers_name,
          'address'=>$request->address,
          'state'=>$request->state,
          'pincode'=>$request->pincode,
          'dob'=>$request->dob,
          'age'=>$request->age,
          'phone'=>$request->phone,
          'alt_phone'=>$request->alt_phone,
          'aadhaar_number'=>$request->aadhaar_number,
          'pan'=>$request->pan,
          'occupation'=>$request->occupation,
          'religion'=>$request->religion,
          'customer_bank_name'=>$request->customer_bank_name,
          'company_bank_name'=>$request->company_bank_name,
          'paid_amount'=>$request->paid_amount,
          'cheque_utr_no'=>$request->cheque_utr_no,
          'date_of_payment'=>$request->date_of_payment,
          'pay_mode'=>$request->pay_mode,
          'project_name'=>$request->project_name,
          'phase_no'=>$request->phase_no,
          'unit_no'=>$request->unit_no,
          'plot_1'=>$request->plot_1,
          'plot_2'=>$request->plot_2,
          'plot_size'=>$request->plot_size,
          'rate'=>$request->rate,
          'transaction_proof' => $transaction_proof,
          'pan_documents' => $pan_documents,
          'adhaar_front' => $adhaar_front,
          'adhaar_back' => $adhaar_back,


      ]);

         $user = User::where('user_key',$request->user_key)->first();
            $user->registry_status = 1;
            $user->save();


      Session::flash('message','Registry Form Filled');
      return redirect('/property/self');
     }


    


}
