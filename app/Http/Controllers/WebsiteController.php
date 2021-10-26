<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WebMessage;
use App\Testimonial;
use App\Download;
use App\DashboardImage;
use DB;
use Session;

class WebsiteController extends Controller
{
    public function newhome()
    {
        $testimonial = Testimonial::where('placement',1)->where('status',1)->orderby('id', 'DESC')->get();
        return view('website.newhome',compact('testimonial'));
    }

    public function index()
    {
        $testimonial = Testimonial::where('placement',1)->where('status',1)->orderby('id', 'DESC')->get();
        return view('website.home',compact('testimonial'));
    }
    public function gallery()
    {
        $DashboardImage = DashboardImage::where('is_dashboard',0)->where('status',1)->orderby('id', 'DESC')->get();
        return view('website.gallery',compact('DashboardImage'));
    }
    
    public function about()
    {
        $testimonial = Testimonial::where('placement',1)->where('status',1)->orderby('id', 'DESC')->get();
        return view('website/about',compact('testimonial'));
    }
    public function services()
    {
        return view('website.services');
    }
    public function downloads()
    {

        $downloads = Download::where('status',1)->orderby('id', 'DESC')->get();
        return view('website/downloads',compact('downloads'));
    }
    public function dholeraSir()
    {
        return view('website.dholera_sir');
    }
    public function healthcu()
    {
        return view('website.healthcu');
    }
    
    public function legals()
    {
        return view('website.legals');
    }
    public function contact()
    {
        return view('website.contact');
    }
    public function privacy()
    {
        return view('website.privacy');
    }

    public function submitSupport(Request $request)
    {
        WebMessage::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'phone'=>$request->phone,
        'message'=>$request->message,
      ]);

        Session::flash('message','Message Sent');
        return redirect()->back();
    }
    
    
    
    

}
