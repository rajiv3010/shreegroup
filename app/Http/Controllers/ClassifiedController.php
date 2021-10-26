<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use File;
use Auth;
use Validator;
use Paginate;
use Illuminate\Routing\UrlGenerator;
use App\Classified\BusinessCategory;
use App\Http\Request\ClassifiedRequest;
use App\BusinessSubCategory;
use App\PaymentMode;
use App\ClassifiedSubcategoryArea;
use App\ClassifiedLevel;
use App\HoursofOperations;
use App\ClassifiedFiles;
use App\User;
use App\Benefits;
use App\Payout;
use App\Classified;
use App\Email;
use App\Activity;
use App\Package;
use App\Pin;
use App\Pincode;
use App\State;
use App\City;
use App\Location;
use App\Charge;
class ClassifiedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $url;
    public function __construct(UrlGenerator $url)
    {
       $this->middleware('auth');
       $this->payouts = new Payout();
       $this->email   = new Email();
       $this->url = $url;

    }

    public function index()
    {
            $classified = Classified::where('user_id',Auth::user()->id)->paginate();
            return view('classified.list')->with('classifieds',$classified);
    }

    public function getSubBusinessCategory($business_category_id)
    {
            $sub_business_category = BusinessSubCategory::where('category_id',$business_category_id)->get();
            echo json_encode($sub_business_category);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classified = Classified::all();
        $packages =   Package::where('business_area_id',5)->get();
        $business_categories =   BusinessCategory::all();
        
        $states =   State::all();
        $paymentmodes =   PaymentMode::all();
        return view('classified.add')
                ->with('states',$states)
                ->with('paymentmodes',$paymentmodes)
                ->with('business_categories',$business_categories)
                ->with('packages',$packages)
                ->with('classifieds',$classified);

    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  



      $customMessages = [
                'required' => 'The :attribute field can not be blank.'
            ];
        $validator = Validator::make($request->all(), [
           'company_name' => 'required',
           'business_category_id' => 'required',
           'business_sub_category_id' => 'required',
           'package_id' => 'required',
           'pin' => 'required',
           'email' => 'required'
        ],$customMessages);



        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
       $count =  Pin::where('package_id',$request->package_id)->where('pin_number',$request->pin)->wherein('status',[1,2])->count();


      if ($count) {

         $customer_id = 'Adyug'.time('Ymid').$request->package_id;
        //if generated key is already exist in the DB then again re-generate key
        do
        {
          $check = Classified::where('customer_id',$customer_id)->count();
          $flag = 1;
          if($check == 1)
          {
            $customer_id = 'Adyug'.time('Ymid').$request->package_id;
            $flag = 0;
          }
        }
        while($flag==0);
      if(Auth::guest()){
         $user_id = 0;
         $admin_id  =  Auth::guard('admins')->user()->id;
         $name  =  'admin';
      }else{
          $admin_id  =0;
          $user_id = Auth::user()->id;
          $name = 'user';
          $package = Package::where('id',$request->package_id)->first();
          $Parentamount =  $this->ClassifiedPayment(Auth::user()->user_key,
          $package->amount,
          $package->classified_earning,
          $request->package_id,
          $request->company_name,
          $customer_id);
         $classifiedLevel = Classifiedlevel::all()->take(10);
         $this->payouts->ClassifiedDistributePayment(Auth::user()->user_key,$Parentamount,$classifiedLevel,5);

      }
          $password = time('isYmd');
          $amenities =  implode(',', $request->amenities);
          $paymentmodes =  implode(',', $request->paymentmodes);
         if($request->hasFile('logo')){
            $file=$request->file('logo');
            $newImageName = rand().$file->getClientOriginalName();
            $MimeType = $file->getMimeType();
            $file->move('assets/classified/photo', $newImageName);
            $logo = $this->url->to('/').env('base_url').'assets/classified/photo/'.$newImageName;
          }
   
          $classified = Classified::create([
            'user_id'=>$user_id,
            'customer_id'=>$customer_id,
            'user_id'=>$user_id,
            'admin_id'=>$admin_id,
            'created_by'=>$admin_id,
            'package_id'=>$request->package_id,
            'company_name'=>$request->company_name,
            'business_category_id'=>$request->business_category_id,
            'state_id'=>$request->state_id,
            'city_id'=>$request->city_id,
            'pincode_id'=>$request->location_id,
            'first_name'=>$request->fistname,
            'last_name'=>$request->lastname,
            'mobile'=>$request->mobilenumber,
            'landline'=>$request->landline,
            'tollfree_number'=>$request->tollfree,
            'amenities'=>$amenities,
            'paymentmodes'=>$paymentmodes,
            'logo'=>$logo,
            'email'=>$request->email,
            'password' => bcrypt($password),
            'website'=>$request->website,
            ]
        );
        foreach ($request->business_sub_category_id as $key => $value) {
        ClassifiedSubcategoryArea::create([
                'classified_id'=>$classified->id,
                'business_sub_category_id'=>$value,
            ]);

        }
            Pin::where('package_id',$request->package_id)->where('pin_number',$request->pin)->update(['status'=>0]);
      
            $this->email->sendClassifiedDetails($classified,$password);
            return redirect('classified');
          }else{
            sessin::flash("message",'Pin notes_body(server, mailbox, msg_number) valid');
             return redirect()->back();

          }

    }

      public function ClassifiedPayment($user_key,$classifiedPackageAmount,$percentage,$package_id,$company_name,$customer_id)
        {

            $description = 'User '.auth::user()->name .'/'.auth::user()->user_key.'created new Classified '.$company_name.'/'.$customer_id;
            Activity::lock($description,auth::user()->user_key,5,0);



              $admincharges = Charge::all();
              $TDMCharges = [];
              foreach ($admincharges as $key => $value) {
              $TDMCharges[$value->code] = $value->percentage;
              }

              $Pamount = $classifiedPackageAmount * 30 / 100;
              $wallet  = DB::table('users')->where('user_key',$user_key)->first();
              if (isset($wallet->id)) {
              $wallet  = $wallet->classified_wallet;
              }else{
              $wallet  = 0;
              }

      if ($wallet > $Pamount) {
       $wallet =  $wallet-$Pamount;
       $earning = $Pamount;
        DB::table('users')->where('user_key',Auth::user()->user_key)->update(['classified_wallet'=>$wallet]);
         $adminamount = $earning*$TDMCharges[1]/100; /*Admin Charge %*/
                          $TDS =  $earning*$TDMCharges[2]/100; /*TDS %*/
                          $deduction = $TDS+$adminamount;
                          $amount1 = $earning-$deduction;
                          $message = 'Company Name: '. $company_name .'/'.$customer_id;
                           DB::table('payouts')->insert([
                                  'user_key'=>Auth::user()->user_key,
                                  'activity_id'=>session('activity_id'),
                                  'amount'=>$amount1,
                                  'percentage'=>$TDMCharges[1]+$TDMCharges[2],
                                  'business_area_id'=>5,
                                  'earning'=>$earning,
                                  'tds'=>$TDS,
                                  'admin_charges'=>$adminamount,
                                  'type'=>'d',
                                  'message'=>$message,
                                  'status'=>0,
                                  'created_at'=>date('Y-m-d')
                              ]);      }else{
                          $newclassifiedPackageAmount = $Pamount - $classifiedPackageAmount;
                          $remaingAmount = $Pamount - $wallet;
                          DB::table('users')->where('user_key',Auth::user()->user_key)->update(['classified_wallet'=>0]);
                          $totalPackageAmount = abs($remaingAmount) + abs($newclassifiedPackageAmount);
                          $earning = $totalPackageAmount * 20 / 100;
                          $earning = $wallet + $earning;
                          $adminamount = $earning*$TDMCharges[1]/100; /*Admin Charge %*/
                          $TDS =  $earning*$TDMCharges[2]/100; /*TDS %*/
                          $deduction = $TDS+$adminamount;
                          $amount1 = $earning-$deduction;
                          $message = 'Company Name: '. $company_name .'/'.$customer_id;
                                  DB::table('payouts')->insert([
                                  'user_key'=>Auth::user()->user_key,
                                  'activity_id'=>session('activity_id'),
                                  'amount'=>$amount1,
                                  'percentage'=>$TDMCharges[1]+$TDMCharges[2],
                                  'business_area_id'=>5,
                                  'earning'=>$earning,
                                  'tds'=>$TDS,
                                  'admin_charges'=>$adminamount,
                                  'type'=>'d',
                                  'message'=>$message,
                                  'status'=>0,
                                  'created_at'=>date('Y-m-d')
                              ]);

      }



     return $earning;
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verifyPin($pin,$package_id)
    {
        echo Pin::where('package_id',$package_id)->where('pin_number',$pin)->wherein('status',[1,2])->count();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
     {

         $classified = Classified::where('id', $id)->first();
         $business_sub_categories =   BusinessSubCategory::where('category_id',$classified->business_category_id)->get();
         $subcates=[];
         foreach ($classified->ClassifiedSubcategoryArea as $key => $subcate) {
                      if (isset($subcate->subcatename->id)) {
                        $subcates[]=$subcate->subcatename->id;
                      }
         }
         $packages =   Package::where('business_area_id',5)->get();
         $business_categories =   BusinessCategory::all();
         $states =   DB::table('states')->get();
         $paymentmodes =   PaymentMode::all();
         $classifiedFiles =   ClassifiedFiles::where('classified_id',$id)->where('file_type','image')->get();
         $locations =   DB::table('pincodes')->where('city_id',$classified->city_id)->get();
         $working_hours =   DB::table('working_hours')->get();
         $HoursofoPerations = HoursofOperations::where('classified_id',$id)->get();
         return view('classified.edit')
                 ->with('classified',$classified)
                 ->with('states',$states)
                 ->with('paymentmodes',$paymentmodes)
                 ->with('business_categories',$business_categories)
                 ->with('business_sub_categories',$business_sub_categories)
                 ->with('subcates',$subcates)
                 ->with('working_hours',$working_hours)
                 ->with('HoursofoPerations',$HoursofoPerations)
                 ->with('locations',$locations)
                 ->with('classifiedFiles',$classifiedFiles)
                 ->with('packages',$packages);
     }
    public function getLatLong($address){
      if(!empty($address)){
          //Formatted address
          $formattedAddr = str_replace(' ','+',$address);
          //Send request and receive json data by address
          $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$formattedAddr."&key=AIzaSyAwUYu08-WX9454mT9NsWhUGG_VL-AcGsA";
          $curl = curl_init($url);
          curl_setopt($curl, CURLOPT_URL, $url);
          curl_setopt($curl, CURLOPT_HEADER, false);
          curl_setopt($curl, CURLOPT_NOBODY, !true);
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
          curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
          curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
          $data = curl_exec($curl);
          curl_close($curl);
          $output = json_decode($data);
          if (isset($output->results[0])) {
            # code...
          //Get latitude and longitute from json data
          $latitude  = $output->results[0]->geometry->location->lat;
          $longitude = $output->results[0]->geometry->location->lng;
          //Return latitude and longitude of the given address
          if($latitude){
              return   array('latitude' =>$latitude,'longitude'=>$longitude);
          }else{
              return false;
          }
          }else{
          return false;

          }
      }else{
          return false;
      }
  }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request)
    {
         if (is_array($request->business_sub_category_id)) {
             $business_sub_category_ids =  implode(',', $request->business_sub_category_id);
             $change = 1;
         } else {
                if (is_array($request->edit_business_sub_category_id)) {
                       $business_sub_category_ids =  implode(',', $request->edit_business_sub_category_id);
                       $change = 0;
                 } else {
                  $business_sub_category_ids = '0';
                 }
                  $business_sub_category_ids = '0';
           }

           
             if ($request->amenities) {
                 $amenities =  implode(',', $request->amenities);
             }
             if ($request->paymentmodes) {
                    $paymentmodes =  implode(',', $request->paymentmodes);
             }
            
          $classified = Classified::find($request->id);
          $classified->company_name = $request->company_name;
          if ($change) {
              $classified->business_category_id = $request->business_category_id;
          }
          $classified->business_sub_category_id = $business_sub_category_ids;
          $classified->first_name = $request->first_name;
          $classified->last_name = $request->last_name;
          $classified->mobile = $request->mobile;
          $classified->landline = $request->landline;
          $classified->tollfree_number = $request->tollfree_number;
          $classified->email =    $request->email;
          $classified->website =  $request->website;
          $classified->city_id = $request->city_id;
          $classified->state_id = $request->state_id;
          $classified->pincode_id = $request->pincode_id;
          $classified->country = $request->country;
          $classified->description = $request->description;
          $classified->address = $request->address;
          $classified->payment_method = $request->payment_method;
          $classified->year_of_establishment = $request->year_of_establishment;
          $classified->annual_turnover = $request->annual_turnover;
          $classified->paymentmodes = $paymentmodes;
          $classified->amenities = $amenities;
          $classified->no_of_employee = $request->no_of_employee;
          $data = $this->getLatLong($request->address);
          if ($data) {
          $classified->latitude = $data['latitude'];
          $classified->longitude = $data['longitude'];
          }

          $this->hoursoperationUpdate($request,$request->id);
          if($request->hasFile('logo')){
            $file=$request->file('logo');
            $newImageName = rand().$file->getClientOriginalName();
            $MimeType = $file->getMimeType();
            $file->move('assets/classified/photo', $newImageName);
            $classified->logo = $this->url->to('/').env('base_url').'assets/classified/photo/'.$newImageName;
          }
          if($request->hasFile('profile_picture')){

            $fileprofile_picture=$request->file('profile_picture');
            $newImageName = rand().$fileprofile_picture->getClientOriginalName();
            $MimeType = $fileprofile_picture->getMimeType();
            $fileprofile_picture->move('assets/classified/photo', $newImageName);
            $classified->profile_picture = $this->url->to('/').env('base_url').'assets/classified/photo/'.$newImageName;
          }
          if($request->hasFile('banner_image')){

            $file=$request->file('banner_image');
            $newImageName = rand().$file->getClientOriginalName();
            $MimeType = $file->getMimeType();

            $file->move('assets/classified/photo', $newImageName);
            $classified->banner_image = $this->url->to('/').env('base_url').'assets/classified/photo/'.$newImageName;
          }
          $classified->save();




          if($files=$request->file('slider_image')){


            foreach($files as $file){
              $newImageName = rand().$file->getClientOriginalName();
              $MimeType = $file->getMimeType();
              $file->move('assets/classified/photo', $newImageName);
              $path = $this->url->to('/').env('base_url').'assets/classified/photo/'.$newImageName;

             ClassifiedFiles::create([
            'file_name'=>$path,
            'file_mime'=>$MimeType,
            'file_type'=>'image',
            'classified_id'=>$request->id,
              ]);
           }
          }

         if (is_array($request->business_sub_category_id)) {
          DB::table('classified_subcategory_areas')
              ->where('classified_id',$request->id)
              ->delete();

          foreach ($request->business_sub_category_id as $key => $bsc) {
              DB::table('classified_subcategory_areas')->insert(['classified_id'=>$request->id,'business_sub_category_id'=>$bsc]);
          }

         } else {
                if (is_array($request->edit_business_sub_category_id)) {
                  DB::table('classified_subcategory_areas')
                    ->where('classified_id',$request->id)
                  ->delete();

             foreach ($request->edit_business_sub_category_id as $key => $bsc) {
                    DB::table('classified_subcategory_areas')->insert(['classified_id'=>$request->id,'business_sub_category_id'=>$bsc]);
                  }

                 } else {

                 }

           }


        return redirect()->back();

}

    public function hoursoperationUpdate($request,$id)
    {
          HoursofOperations::where('classified_id',$id)->delete();
          $HoursofoPerations = HoursofOperations::firstOrCreate(array('start_time'=>$request->mondaystart,'closing_time'=>$request->mondayend,'classified_id' => $id,'days'=>'Monday'));
          $HoursofoPerations->days='Monday';
          $HoursofoPerations->start_time=$request->mondaystart;
          $HoursofoPerations->closing_time=$request->mondayend;
          $HoursofoPerations->save();
        
          $HoursofoPerations = HoursofOperations::firstOrCreate(array('start_time'=>$request->tuesdaystart,'closing_time'=>$request->tuesdayend,'classified_id' => $id,'days'=>'Tuesday'));
          $HoursofoPerations->days='Tuesday';
          $HoursofoPerations->start_time=$request->tuesdaystart;
          $HoursofoPerations->closing_time=$request->tuesdayend;
          $HoursofoPerations->save();
         
          $HoursofoPerations = HoursofOperations::firstOrCreate(array('start_time'=>$request->wednesdaystart,'closing_time'=>$request->wednesdayend,'classified_id' => $id,'days'=>'Wednesday'));
          $HoursofoPerations->days='Wednesday';
          $HoursofoPerations->start_time=$request->wednesdaystart;
          $HoursofoPerations->closing_time=$request->wednesdayend;
          $HoursofoPerations->save();

          $HoursofoPerations = HoursofOperations::firstOrCreate(array('start_time'=>$request->thursdaystart,'closing_time'=>$request->thursdayend,'classified_id' => $id,'days'=>'Thursday'));
          $HoursofoPerations->days='Thursday';
          $HoursofoPerations->start_time=$request->thursdaystart;
          $HoursofoPerations->closing_time=$request->thursdayend;
          $HoursofoPerations->save();

          $HoursofoPerations = HoursofOperations::firstOrCreate(array('start_time'=>$request->fridaystart,'closing_time'=>$request->fridayend,'classified_id' => $id,'days'=>'Friday'));
          $HoursofoPerations->days='Friday';
          $HoursofoPerations->start_time=$request->fridaystart;
          $HoursofoPerations->closing_time=$request->fridayend;
          $HoursofoPerations->save();
          
          $HoursofoPerations = HoursofOperations::firstOrCreate(array('start_time'=>$request->saturdaystart,'closing_time'=>$request->saturdayend,'classified_id' => $id,'days'=>'Saturday'));
          $HoursofoPerations->days='Saturday';
          $HoursofoPerations->start_time=$request->saturdaystart;
          $HoursofoPerations->closing_time=$request->saturdayend;
          $HoursofoPerations->save();
          
          $HoursofoPerations = HoursofOperations::firstOrCreate(array('start_time'=>$request->sundaystart,'closing_time'=>$request->sundayend,'classified_id' => $id,'days'=>'Sunday'));
          $HoursofoPerations->days='Sunday';
          $HoursofoPerations->start_time=$request->sundaystart;
          $HoursofoPerations->closing_time=$request->sundayend;
          $HoursofoPerations->save();

          return true;

    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
   
    }
}
