<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\PropertyAllotment;
use App\Events\StatusLiked;
use DB;
use File;
use Auth;
use Paginate;
use Session;
use DateTime;
use \Carbon\Carbon;

class PropertyController extends Controller
{
    
    public function self()
    {
    	$allotedProperty = PropertyAllotment::where('user_key',auth::user()->user_key)->get();
        return view('users/property/self',compact('allotedProperty'));
    }

}
