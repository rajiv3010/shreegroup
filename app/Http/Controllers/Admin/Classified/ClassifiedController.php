<?php

namespace App\Http\Controllers\Admin\Classified;
use App\Http\Controllers\Controller;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Http\Request;
use DB;
use File;
use Auth;
use Session;
use Paginate;
use App\Classified\BusinessCategory;
use App\Classified\BusinessSubCategory;
use App\Classifiedlevel,App\ClassifiedFiles,App\ClassifiedSubcategoryArea;
use App\ClassifiedBenefits;
use App\Benefits;
use App\Payout;
use App\PaymentMode;
use App\Classified;
use App\Package;
use App\Pin;
use App\State;
use App\City;
use App\Admin;
use App\Location;
use App\Email;
use App\HoursofOperations;
use Validator;
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
        $this->url = $url;
        $this->middleware('auth:admin');
       $this->payouts = new Payout();
       $this->email = new Email();
    }

    public function index()
    {

            $admin = Admin::find(auth::guard('admin')->user()->id);
            if($admin->role->role_name=="admin"){
            $classifieds = Classified::orderBy('status', 'ASC')->get();
            }else{
            $classifieds = Classified::orderBy('status', 'ASC')->where('admin_id',$admin->id)->get();
            }
            foreach ($classifieds as $key => $classified) {
              $classified->referalCount = Classified::where('referal_by',$classified->customer_id)->count();
            }
            return view('admin.classified.list',compact('classifieds'));
    }

   public function Service24X7()
    {
            $admin = Admin::find(auth::guard('admin')->user()->id);
            if($admin->role->role_name=="admin"){
            $classifieds = Classified::orderBy('status', 'ASC')->where('is_24x7',1)->get();
            }else{
            $classifieds = Classified::orderBy('status', 'ASC')->where('is_24x7',1)->where('admin_id',$admin->id)->get();
            }
            foreach ($classifieds as $key => $classified) {
              $classified->referalCount = Classified::where('referal_by',$classified->customer_id)->count();
            }
            return view('admin.classified.list',compact('classifieds'));
    }

   public function classifiedReferal($customer_id)
    {
            $classifieds = Classified::where('referal_by',$customer_id)->orderBy('status', 'ASC')->get();
     
            return view('admin.classified.list',compact('classifieds'));
    }

   public function noWebsite()
    {
           $admin = Admin::find(auth::guard('admin')->user()->id);
            if($admin->role->role_name=="admin"){
            $classifieds = Classified::orderBy('status', 'ASC')->where('website', '=','')
            ->orWhere('website', '=', 'NA')
            ->orWhere('website', '=', 'na')
        ->orWhereNull('website')->get();
            }else{
            $classifieds = Classified::orderBy('status', 'ASC')->where('website', '=','')
            ->orWhere('website', '=', 'NA')
            ->orWhere('website', '=', 'na')
        ->orWhereNull('website')->where('admin_id',$admin->id)->get();
            }
            foreach ($classifieds as $key => $classified) {
              $classified->referalCount = Classified::where('referal_by',$classified->customer_id)->count();
            }

            return view('admin.classified.list',compact('classifieds'));
    }
   public function freeListing()
    {
            $classifieds = Classified::orderBy('status', 'ASC')->where('status',2)->get();

            return view('admin.classified.free-listing',compact('classifieds'));
    }
   public function approved()
    {


            $admin = Admin::find(auth::guard('admin')->user()->id);
            if($admin->role->role_name=="admin"){
            $classifieds = Classified::orderBy('status', 'ASC')->where('status',1)->get();
            }else{
            $classifieds = Classified::orderBy('status', 'ASC')->where('status',1)->where('admin_id',$admin->id)->get();
            }
            foreach ($classifieds as $key => $classified) {
              $classified->referalCount = Classified::where('referal_by',$classified->customer_id)->count();
            }
            return view('admin.classified.list',compact('classifieds'));
    }
   public function pending()
    {

            $admin = Admin::find(auth::guard('admin')->user()->id);
            if($admin->role->role_name=="admin"){
            $classifieds = Classified::orderBy('status', 'ASC')->where('status',0)->get();
            }else{
            $classifieds = Classified::orderBy('status', 'ASC')->where('status',0)->where('admin_id',$admin->id)->get();
            }
            foreach ($classifieds as $key => $classified) {
              $classified->referalCount = Classified::where('referal_by',$classified->customer_id)->count();
            }
            return view('admin.classified.list',compact('classifieds'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classified = Classified::orderBy('created_at', 'ASC')->get();
        $packages =   Package::where('business_area_id',5)->get();
        $business_categories =   BusinessCategory::all();
        $business_sub_categories =   BusinessSubCategory::all();
        $locations =   DB::table('pincodes')->get();
        $states =   State::all();
        return view('admin.classified.add')
                ->with('states',$states)
                ->with('business_categories',$business_categories)
                ->with('business_sub_categories',$business_sub_categories)
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

/*              $count =  Pin::where('package_id',$request->package_id)->where('pin_number',$request->pin)->where('status',1)->count();*/
          $count=1;
          if ($count) {

         $user_id = 0;
         $admin_id  =  Auth::guard('admin')->user()->id;
         $name  =  'admin';
          $password = rand(111111,999999.66);
          $customer_id = rand(1111111111,999999999.9);
        //if generated key is already exist in the DB then again re-generate key
        do
        {
          $check = Classified::where('customer_id',$customer_id)->count();
          $flag = 1;
          if($check == 1)
          {
            $customer_id = rand(1111111111,9999999999);
            $flag = 0;
          }
        }
        while($flag==0);
        $amenities= [];
        $paymentmodes= [];
        if ($request->amenities) {
         $amenities =  implode(',', $request->amenities);

        }if ($request->paymentmodes) {
          # code...
         $paymentmodes =  implode(',', $request->paymentmodes);
        }
          $is_24x7 = 0;
          if ($request->is_24x7) {
             $is_24x7 =1;
          }

          $classified = Classified::create([
            'user_id'=>$user_id,
            'customer_id'=>$customer_id,
            'admin_id'=>$admin_id,
            'is_24x7'=>$is_24x7,
            'created_by'=>$admin_id,
            'company_name'=>$request->company_name,
            'business_category_id'=>$request->business_category_id,
            'state_id'=>$request->state_id,
            'city_id'=>$request->city_id,
            'pincode_id'=>$request->pincode_id,
            'first_name'=>$request->fistname,
            'last_name'=>$request->lastname,
            'mobile'=>$request->mobilenumber,
            'landline'=>$request->landline,
            'tollfree_number'=>$request->tollfree,
            'email'=>$request->email,
            'password' => bcrypt($password),
            'website'=>$request->website,
            ]
        );
         foreach ($request->business_sub_category_id as $key => $value) {
        ClassifiedSubcategoryArea::create([
                'classified_id'=>$classified->id,
                'business_sub_category_id'=>$value
            ]);

        }
            Pin::where('package_id',$request->package_id)->where('pin_number',$request->pin)->update(['status'=>0]);
           $this->email->sendClassifiedDetails($classified,$password);
            return redirect('admin/classified/');
          }else{
             return redirect()->back();

          }

    }
     public function show($id)
    {
         return view('admin.classified.list');
    }

  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function benefits($classified_id)
    {

        $classified =  Classified::find($classified_id);
        if (count($classified)) {
               $benefits=Benefits::where('package_id',$classified->package_id)->get();
               return view('admin.classified.benefits',compact('benefits','classified','classified_id'));

        }else{
          session::flash("message","You are accessing wrong client details");
          return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addBenefits(Request $request)
    {

            ClassifiedBenefits::where('classified_id',$request->classified_id)->delete();
            foreach ($request->benefits as $key => $value) {
                 ClassifiedBenefits::updateOrCreate(
                          ['benefits_id' => $value, 'classified_id' => $request->classified_id]
                  );
            }
            session::flash("message",'Classified benefits has been updated');
            return redirect()->back();
    }
   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendEmailToClassified(Request $request)
    {
            $classified = Classified::find($request->classified_id);
            $this->email->sendBenefitsEmailDetails($request,$classified);
            session::flash("message",'Classified benefits has been updated');
            return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

      public function ClassifiedPayment($user_key,$packageAmount,$percentage,$package_id,$package)
    {

          $Pamount = $packageAmount * $percentage / 100;
          $cw  = DB::table('classified_wallets')->where('user_key',$user_key)->first();
            if (count($cw)) {
                  $wallet = $cw->amount;
            }else{
                  $wallet = 0;

            }
      if ($wallet > $Pamount) {
                $wallet  =  $wallet-$Pamount;
                DB::table('classified_wallets')->where('user_key',$user_key)->update(['amount'=>$wallet]);
                DB::table('payouts')->insert([
                'user_key'=>$user_key,
                'amount'=>$Pamount,
                'percentage'=>$percentage,
                'business_area_id'=>5,
                'created_at'=>date('Y-m-d')
                ]);
            return $Pamount;
      }else{
        //Setp1
       $newPackageAmount = $Pamount - $packageAmount;
       //Setp2
       $remaingAmount = $Pamount - $wallet;
       DB::table('classified_wallets')->where('user_key',$user_key)->update(['amount'=>0]);
       $totalPackageAmount = abs($remaingAmount) + abs($newPackageAmount);
       $earning = $totalPackageAmount * $package->classified_earning / 100;
       $earning = $wallet + $earning;
        DB::table('payouts')->insert([
                                  'user_key'=>$user_key,
                                  'amount'=>$earning,
                                  'percentage'=>$package->classified_earning,
                                  'business_area_id'=>5,
                                  'created_at'=>date('Y-m-d')
                              ]);
        return $earning;
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verifyPin($pin,$package_id)
    {
        echo Pin::where('package_id',$package_id)->where('pin_number',$pin)->where('status',1)->count();
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
        $classifiedFiles =   ClassifiedFiles::where('classified_id',$id)->where('file_type','image')->get();
        $locations =   DB::table('pincodes')->where('city_id',$classified->city_id)->get();
        $working_hours =   DB::table('working_hours')->get();
        $HoursofoPerations = HoursofOperations::where('classified_id',$id)->get();
        $paymentmodes =   PaymentMode::all();
        return view('admin.classified.edit')
                ->with('classified',$classified)
                ->with('states',$states)
                 ->with('paymentmodes',$paymentmodes)
                ->with('locations',$locations)
                ->with('business_categories',$business_categories)
                ->with('business_sub_categories',$business_sub_categories)
                ->with('subcates',$subcates)
                ->with('classifiedFiles',$classifiedFiles)
                ->with('HoursofoPerations',$HoursofoPerations)
                ->with('working_hours',$working_hours)
                ->with('packages',$packages);
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
//       dd($request->all());
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

          $classified = Classified::find($request->id);
          $classified->company_name = $request->company_name;
          if ($change) {
              $classified->business_category_id = $request->business_category_id;
          }
          $amenities    = implode(',', $request->amenities);
          $paymentmodes = implode(',', $request->paymentmodes);
          $is_24x7 = 0;
          if ($request->is_24x7) {
             $is_24x7 =1;
          }

          $classified->business_sub_category_id = $business_sub_category_ids;
          $classified->first_name = $request->first_name;
          $classified->last_name = $request->last_name;
          $classified->is_24x7 = $is_24x7;
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
          $classified->amenities = $amenities;
          $classified->paymentmodes = $paymentmodes;
          $classified->year_of_establishment = $request->year_of_establishment;
          $classified->annual_turnover = $request->annual_turnover;
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
                    DB::table('classified_subcategory_areas')->insert(['classified_id'=>$request->id,'business_sub_category_id'=>$bsc,'status'=>$classified->status]);
                  }

                 } else {

                 }

           }

        session::flash("message",$classified->company_name.' has been updated');
        return redirect('/admin/classified');

}
public function deleteClassifiedImage($id)
{
   $file =  ClassifiedFiles::find($id);
   $file->delete();
   session::flash("message","Image has been removed");
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

        $classified = Classified::find($id);
        $classified->delete();
        Session::flash('message','Record has been deleted');
        return redirect()->back();
    }


    public function ChangeStatus($status,$id)
    {
        $classified = Classified::find($id);
        $classified->status =$status;
        $classified->update();
        ClassifiedSubcategoryArea::where('classified_id',$id)->update(['status'=>$status]);
        session::flash('message','Satus has been changed');
        return redirect()->back();
    }
}
//  By Dileep
