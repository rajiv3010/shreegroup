<?php

namespace App\Http\Controllers\Admin\Package;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BusinessArea;
use App\Package;
use App\Charge;
use App\PackageType;
use App\BinaryLevel;
use App\LevelLimitPercentage;
use DB;
use File;
use Auth;
use Paginate;
use Session;

class PackageController extends Controller
{

  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
      $binaryLevel = BinaryLevel::get();
      $charges = Charge::get();
      $chargesBinary = Charge::where('id',3)->get();
       $business_areas =   BusinessArea::all();
       $PackageType =   PackageType::all();
        $packages = Package::orderby('created_at','DESC')->get();

        return view('admin/package/add')
        ->with('business_areas',$business_areas)
        ->with('PackageType',$PackageType)
        ->with('packages',$packages)
        ->with('chargesBinary',$chargesBinary)
        ->with('charges',$charges)
        ->with('binaryLevel',$binaryLevel);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            // $business_areas = BusinessArea::all();
             $business_areas =   BusinessArea::all();
             $PackageType =   PackageType::all();
        $packages = Package::orderby('created_at','DESC')->get();

        return view('admin.package.add')
        ->with('business_areas',$business_areas)
        ->with('PackageType',$PackageType)
        ->with('packages',$packages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         Package::create([

        
      'name'=>$request->name,
      'business_area_id'=>$request->business_area_id,
      'amount'=>$request->amount,
      'point_value'=>$request->point_value,
      'direct_income'=>$request->direct_income,
      'daily_caping'=>0,
      'package_type_id'=>$request->package_type_id,
      'tenure'=>$request->tenure,
      'level_limit'=>$request->level_limit,
      'cash_back_count'=>0,
      'cost_per_lead'=>0,
      'instant_cash_back'=>0,
      'current_property_amount'=>$request->current_property_amount,

      ]);

Session::flash('message','Package has been inserted');
      return redirect()->back();
     }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $business_areas =   BusinessArea::all();
        $PackageType =   PackageType::all();
        $packages = Package::orderby('id','ASC')->get();
        return view('admin.package.view')->with('business_areas',$business_areas)->with('packages',$packages)->with('PackageType',$PackageType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::find($id);
         $PackageType =   PackageType::all();
        $business_areas =   BusinessArea::all();
        return view('admin/package/edit',compact('package','business_areas','PackageType'));

    }
    public function changeStatus($package_id,$status)
    {
        $package = Package::find($package_id);
        $package->status =$status;
        $package->save();
        session::flash("message","Package status has been changed");
        return redirect()->back();


    }
    
    public function editChargesView()
    {
        $charges = Charge::find($id);
         $PackageType =   PackageType::all();
        $business_areas =   BusinessArea::all();
        return view('admin/package/edit',compact('package','business_areas','PackageType'));

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
      $package = Package::find($request->id);
      $package->name = $request->name;
      $package->business_area_id = $request->business_area_id;
      $package->amount = $request->amount;
      $package->point_value = $request->point_value;
      $package->daily_caping = 0;
      $package->direct_income = $request->direct_income;
      $package->package_type_id = $request->package_type_id;
      $package->tenure = $request->tenure;
      $package->level_limit = $request->level_limit;
      $package->cash_back_count=0;
      $package->cost_per_lead=0;
      $package->instant_cash_back=$request->instant_cash_back;
      $package->current_property_amount = $request->current_property_amount;
      $package->save();

        session::flash("message","Your package has been updated");
        return redirect('/admin/package');
    }

    public function chargesupdate(Request $request)
    {
        foreach ($request->all() as $key => $value) {
          if ($key=="_token") {
            
          }else{
          $charge = Charge::find($key);
          $charge->percentage = $value;
          $charge->save();
          }
        }

        session::flash("message","Your Charges has been updated");
        return redirect('/admin/package');
    }
    
    public function levelPercentageupdate(Request $request)
    {
        foreach ($request->all() as $key => $value) {
          if ($key=="_token") {
            
          }else{
          $binaryLevel = BinaryLevel::find($key);
          $binaryLevel->percentage = $value;
          $binaryLevel->save();
          }
        }

        session::flash("message","Level % has been updated");
        return redirect('/admin/package');
    }

    public function levelLimitPercentageupdate(Request $request)
    {
        

        for ($i=0; $i <=count($request->percentage)-1 ; $i++) { 
              LevelLimitPercentage::updateorcreate(['package_id'=>$request->packageID,'level'=>$i+1],[
                'package_id'=>$request->packageID,
                'percentage'=>$request->percentage[$i],
                'direct'=>$request->direct[$i],

        ]);

        }


        return redirect('/admin/package');
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


    

    
}
