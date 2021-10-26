<?php

namespace App\Http\Controllers\Admin;

use App\Make;
use App\CarImage;
use App\CarModel;
use App\Car;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\UrlGenerator;
class CarController extends Controller
{

   protected $url;
   public function __construct(UrlGenerator $url)
   {
       $this->url = $url;
       $this->middleware('auth:admin');
   }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all();
        return view('admin.car.list',compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $makes = Make::all();
          return view('admin.car.add',compact('makes'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getModel(Request $request)
    {
          $models = CarModel::where('make_id',$request->make_id)->get();
          echo json_encode($models);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $car = Car::create([
                "make_id" =>$request->make_id,
                "model_id" =>$request->model_id,
                "name" =>$request->name,
                "mileage" =>$request->mileage,
                "engine" =>$request->engine,
                "BHP" =>$request->BHP,
                "transmission" =>$request->transmission,
                "seats" =>$request->seats,
                "fuel_type" =>$request->fuel_type,
                "arai" =>$request->arai,
                "price" =>$request->price,
                "emi_description" =>$request->emi_description,
                "emi_start_price" =>$request->emi_start_price,
                "km" =>$request->km,
                "description" =>$request->description,
          ]);
          if($files=$request->file('images')){
              foreach($files as $file){
                    $newImageName = rand().$file->getClientOriginalName();
                    $MimeType = $file->getMimeType();
                    $file->move('assets/car/photo', $newImageName);
                    $path = $this->url->to('/').env('base_url').'assets/car/photo/'.$newImageName;
                  $carImage =   CarImage::create([
                    'car_id'=>$car->id,
                    'image'=>$path,
                    ]);
              }
          }
          $car->cover_image = $carImage->image;
          $car->save();
          session::flash("message",'Car has been created');
          return redirect('/admin/car');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Make  $make
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::find($id);
        return view('admin.car.show',compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Make  $make
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $car = Car::find($id);
      $models = CarModel::where('make_id',$car->make_id)->get();
      $makes = Make::all();
      return view('admin.car.edit',compact('car','models','makes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Make  $make
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
      $car = Car::find($id);
      $car->make_id =$request->make_id;
      $car->model_id =$request->model_id;
      $car->name =$request->name;
      $car->mileage =$request->mileage;
      $car->engine =$request->engine;
      $car->emi_start_price =$request->emi_start_price;
      $car->emi_description =$request->emi_description;
      $car->BHP =$request->BHP;
      $car->transmission =$request->transmission;
      $car->seats =$request->seats;
      $car->fuel_type =$request->fuel_type;
      $car->arai =$request->arai;
      $car->price =$request->price;
      $car->km =$request->km;
      $car->description =$request->description;
      $car->save();

      if($files=$request->file('images')){
          foreach($files as $file){
                $newImageName = rand().$file->getClientOriginalName();
                $MimeType = $file->getMimeType();
                $file->move('assets/car/photo', $newImageName);
                $path = $this->url->to('/').env('base_url').'assets/car/photo/'.$newImageName;
                $carImage =   CarImage::create([
                'car_id'=>$id,
                'image'=>$path,
                ]);
          }
      }
      session::flash("message",'Car details been updated');
      return redirect('/admin/car');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Make  $make
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::find($id);
        $car->delete();
        session::flash("message",'Car has been removed');
        return redirect('/admin/car');
    }

    public function makeCoverImage($image_id,$car_id)
    {
        $image = CarImage::find($image_id);
        $car   = Car::find($car_id);
        $car->cover_image=$image->image;
        $car->save();
        session::flash("message","Car cover pic has been changed");
        return redirect()->back();
    }

    public function carStatus($car_id,$status)
    {   
        $car = Car::find($car_id);
        $car->status=$status;
        $car->save();
        session::flash("message","Car status has been changed");
        return redirect()->back();
    }

    public function CarImagesDelete($id)
    {
        CarImage::where('id',$id)->delete();
        session::flash("message",'Car Image  has been removed');
        return redirect()->back();
    }
}
