<?php

namespace App\Http\Controllers\Admin\Mall;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mall\Order;
use App\Mall\OrderDetails;
use App\Mall\OrderStatus;
use File;
use Storage;
use Paginate;
use DB;
use Session;
use Validator;

Class OrderController extends Controller
{
    
      public function __construct()
    {
      $this->middleware('auth:admin');   
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$orders = Order::orderby('created_at','DESC')->get();
       return view('admin.mall.order.list',compact('orders'));
	}
	public function orderDetails($orderNumber)
    {
    	$OrderDetails = OrderDetails::where('order_id',$orderNumber)->get();
    	$allOrderStatus = OrderStatus::all();

       return view('admin.mall.order.orderList',compact('OrderDetails','allOrderStatus'));
	}
	public function orderDetailsStatus($orderDetailID,$status)
    {
    	$OrderDetails = OrderDetails::where('id',$orderDetailID)->update(['order_status_id'=>$status]);
    	echo 1;
	}
}