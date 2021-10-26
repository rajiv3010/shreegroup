<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class Home extends Model
{
    
    public function getDashboardCount() {
        $from  = date('Y-m-d 00:00:00');
        $to  = date('Y-m-d h:i:s');
        $count['restaurants'] = DB::table('restaurants')->count();
        $count['topRestaurant'] =  DB::table('orders')->select((DB::raw('count(*) as count ,restaurants.name as rname')))
            ->join('restaurants','restaurants.id','=','orders.restaurant_id')
            ->groupby('restaurant_id')
            ->get();

        $count['pendingReq'] = DB::table('restaurants')->where('status',0 )->count();
        $count['approvReq'] = DB::table('restaurants')->where('status',1 )->count();

        return $count;
    }

    public function customers()
    {  
        $customers = DB::table('customers')->get();        
        return view('pages.customer.list')->with('customers',$customers);
    }
}
