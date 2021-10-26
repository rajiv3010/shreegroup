<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Tree extends Model
{

  public $parent=   array();
  public $user_data=   array();
  public $pv=0;

  protected $fillable = [

      'user_id', 'user_reference_id','user_placement_id','placement'
  ];
  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
   public function user(){
     return $this->belongsTo('App\User');
   }


/**************************************************************
**************************Binary Status*************************
****************************************************************/
public function totalLeftLegUsersByDate($pkey)
{

  $data =  DB::table('leftleg')
                ->select('packages.id as package_id',DB::raw("IFNULL(sum(packages.point_value),0) as lpv"),'leftleg.created_at as rdate','leftleg.id as lid',DB::raw("IFNULL(count(leftleg.id),0) as L_count",'users.name'))
                ->join('users','leftleg.ukey','=','users.user_key')
                ->join('packages','packages.id','=','users.package_id')
                ->groupby('leftleg.created_at')
                ->where('pkey',$pkey)
                ->get()->Toarray();
  return  $data;
}

public function totalRightLegUsersByDate($pkey)
{


  $data =  DB::table('rightleg')
                ->select('packages.id as package_id',DB::raw("IFNULL(sum(packages.point_value),0) as rpv"),'rightleg.created_at as rdate','rightleg.id as rid',DB::raw("IFNULL(count(rightleg.id),0) as r_count",'users.name'))
                ->join('users','rightleg.ukey','=','users.user_key')
                ->join('packages','packages.id','=','users.package_id')
                ->groupby('rightleg.created_at')
                ->where('pkey',$pkey)
                ->get()->Toarray();
  return  $data;

}

/**************************************************************
**************************Binary Status*************************
****************************************************************/






public function totalRightLegUsers($pkey)
{

  $data =  DB::table('rightleg')
                ->select(DB::raw("IFNULL(sum(packages.point_value),0) as pv"),DB::raw("IFNULL(count(rightleg.id),0) as count"))
                ->Leftjoin('users','rightleg.ukey','=','users.user_key')
                ->Leftjoin('packages','packages.id','=','users.package_id')
                ->where('pkey',$pkey)->get();

    foreach ($data as $key => $value) {
      $countData['pv']=$value->pv;
      $countData['count']=$value->count;
    }
  return $countData;

}

public function myFiveRightLegUsers($pkey)
{
 $results = DB::select("SELECT name, payment_status,parent_key,user_key,leg,id,sponsor_key
                FROM users
                WHERE user_key IN
                (
                      SELECT ukey
                      FROM rightleg
                      WHERE pkey = '".$pkey."'
                      ORDER BY id DESC
                )
                limit 0, 1
");
  $i = 0;
  $parent_key = 0;
  if(count($results) > 0)
  {
    foreach($results as $data)
    {
      $users[$i]['name'] = $data->name;
      $users[$i]['id'] = $data->user_key;
      $users[$i]['parent'] = $data->parent_key;
      $users[$i]['sponsor_key'] = $data->sponsor_key;
      $users[$i]['leg'] = $data->leg;
      $users[$i]['payment_status'] = $this->activeNotActive($data->payment_status);
      $i++;
      $parent_key = $data->parent_key;
    }
  }
  else
  {
    $retVal = rand(1000000,9999999);
      $users[$i]['name'] = 'Add new Left';
      $users[$i]['id'] = $retVal;
      $users[$i]['parent'] = $pkey;
      $users[$i]['sponsor_key'] = 0;
      $users[$i]['leg'] = 0;
      $users[$i]['url'] = '/register/'.$data->user_key;
      $users[$i]['payment_status'] = '';

      $retVal = rand(1000000,9999999); 
      $users[$retVal]['name'] = 'Add New Left';
      $users[$retVal]['id'] = $retVal;
      $users[$retVal]['parent'] = $pkey;
      $users[$retVal]['sponsor_key'] = 0;
      $users[$retVal]['leg'] = 0;
      $users[$retVal]['url'] = '/register/'.$data->user_key;
      $users[$retVal]['payment_status'] = '';


  }
  return $users;
}

public function myRightLeg($pkey)
{
 $results = DB::select("SELECT name, payment_status,parent_key,user_key,leg,id,sponsor_key
                FROM users
                WHERE user_key IN
                (
                      SELECT ukey
                      FROM rightleg
                      WHERE pkey = '".$pkey."'
                      ORDER BY id DESC
                )
                limit 0, 1
");
  $i = 0;
  $parent_key = 0;
  if(count($results) > 0)
  {
    foreach($results as $data)
    {
      $users[$i]['name'] = $data->name;
      $users[$i]['id'] = $data->user_key;
      $users[$i]['parent'] = $data->parent_key;
      $users[$i]['sponsor_key'] = $data->sponsor_key;
      $users[$i]['leg'] = $data->leg;
      $users[$i]['url'] = '/referal/tree/user/'.$data->user_key;
      $users[$i]['payment_status'] = $this->activeNotActive($data->payment_status);
      $i++;
      $parent_key = $data->parent_key;
    }
  }
  else
  {
     return 1;


  }
  return $users;
}


   public function myFiveLeftLegUsers($pkey)
{
  
    $results =  DB::select("SELECT name, payment_status,parent_key,user_key,leg,sponsor_key
                FROM users
                WHERE user_key IN
                (
                      SELECT ukey
                      FROM leftleg
                      WHERE pkey = '".$pkey."'
                      ORDER BY id DESC
                )
                limit 0, 1
                ");
     $i = 0;
      $parent_key = 0;
      if(count($results) > 0)
      {
       
        foreach($results as $data)
        {
          $users[$i]['name'] = $data->name;
          $users[$i]['id'] = $data->user_key;
          $users[$i]['parent'] = $data->parent_key;
          $users[$i]['sponsor_key'] = $data->sponsor_key;
          $users[$i]['leg'] = $data->leg;
          $users[$i]['url'] = '/referal/tree/user/'.$data->user_key;
          $users[$i]['payment_status'] = $this->activeNotActive($data->payment_status);
          $i++;
          $parent_key = $data->parent_key;
        }
      
      }
       else
      {
          $retVal = rand(1000000,9999999);
          $users[$i]['name'] = $pkey.'-LEFT';
          $users[$i]['id'] = $retVal;
          $users[$i]['parent'] = $pkey;
          $users[$i]['sponsor_key'] = 0;
          $users[$i]['leg'] = 1;
          $users[$i]['url'] = '/register/'.$data->user_key;
          $users[$i]['payment_status'] = '';

          $retVal = rand(1000000,9999999);
          $users[$retVal]['name'] = $pkey.'-RIGHT';
          $users[$retVal]['id'] = $retVal;
          $users[$retVal]['parent'] = $pkey;
          $users[$retVal]['sponsor_key'] = 0;
          $users[$retVal]['leg'] = 0;
          $users[$retVal]['url'] = '/register/'.$data->user_key;
          $users[$retVal]['payment_status'] = '';
       
      }
      return $users;
}




  public function myLeftLeg($pkey)
{
  
    $results =  DB::select("SELECT name, payment_status,parent_key,user_key,leg,sponsor_key
                FROM users
                WHERE user_key IN
                (
                      SELECT ukey
                      FROM leftleg
                      WHERE pkey = '".$pkey."'
                      ORDER BY id DESC
                )
                limit 0, 3
                ");
     $i = 0;
      $parent_key = 0;
      if(count($results) > 0)
      {
        foreach($results as $data)
        {
          $users[$i]['name'] = $data->name;
          $users[$i]['id'] = $data->user_key;
          $users[$i]['parent'] = $data->parent_key;
          $users[$i]['sponsor_key'] = $data->sponsor_key;
          $users[$i]['leg'] = $data->leg;
          $users[$i]['payment_status'] = $this->activeNotActive($data->payment_status);
          $i++;
          $parent_key = $data->parent_key;
        }
      }
       else
      {
         return 1;
       
      }
      return $users;
}


public function myRightLegUsers($pkey)
{

 $results = DB::select("SELECT users.ip,users.is_online,users.leg,users.created_at,users.user_key,users.name,`users`.`sponsor_key`,users.parent_key,users.city,users.mobile,packages.name as package_name
                FROM users
                Join packages
                ON packages.id = users.package_id
                WHERE user_key IN ".$pkey." ORDER BY id DESC ");
  return $results;
}

   public function myLeftLegUsers($pkey)
{


    $results =  DB::select("SELECT users.ip,users.is_online,users.leg,users.created_at,users.user_key,users.name,`users`.`sponsor_key`,users.parent_key,users.city,users.mobile,packages.name as package_name
                FROM users
                Join packages
                ON packages.id = users.package_id
                WHERE user_key IN ".$pkey." ORDER BY id DESC");
    return $results;
}





function activeNotActive($status)
{
  if($status == '1')
    return 'Active';
  else
    return 'Not Active';
}


  // My tree machine
// Binary TREEE
   public  function generatePageTree($datas, $parent = 0, $limit=0){

      if($limit >= 2) return ''; // Make sure not to have an endless recursion
      $tree = '<ul>';
      for($i=0, $ni=count($datas); $i < $ni; $i++){
        if($datas[$i]['parent_key'] == $parent){
                if ($datas[$i]['leg']) {
                    $placement = 'right';
                }else{
                    $placement = 'left';

                }
              $a =   '/referal/tree/user/'.$datas[$i]['user_key'];
              $b =   '/referal/tree/adduser/'.$datas[$i]['user_key'];
              $url = ($datas[$i]['name']=='Add new Member') ? $b : $a ;
              $tree .= '<li>
                    <div class="profile '.$placement.'">
                    <a href="'.$url.'">' .$datas[$i]['name'].'
                  </div>';
          $tree .= $this->generatePageTree($datas, $datas[$i]['user_key'], $limit++);
          $tree .= '</a></li>';
        }

      }
      $tree .= '</ul>';
      return $tree;
    }


    public  function associateTree($datas, $parent = 0, $limit=0){

      if($limit > 999) return ''; // Make sure not to have an endless recursion
      $tree = '<ul>';
      for($i=0, $ni=count($datas); $i < $ni; $i++){
        if($datas[$i]['parent_key'] == $parent){
                if ($datas[$i]['leg']) {
                    $placement = 'right';
                }else{
                    $placement = 'left';

                }
              $a =   '/admin/associate/tree/user/'.$datas[$i]['user_key'];
              $b =   '/tree/adduser/'.$datas[$i]['user_key'];
              $url = ($datas[$i]['name']=='Add new Member') ? $b : $a ;
              $tree .= '<li>
                    <div class="profile '.$placement.'">
                    <a href="'.$url.'">'.$datas[$i]['name'].'
                  </div></a>';
          $tree .= $this->associateTree($datas, $datas[$i]['user_key'], $limit++);
          $tree .= '</a></li>';
        }

      }
      $tree .= '</ul>';
      return $tree;
    }

  // GENERATION CHART
   public  function generationChart($datas, $parent = 0, $limit=0){

            if($limit > 999) return ''; // Make sure not to have an endless recursion
      $tree = '<ul>';
      for($i=0, $ni=count($datas); $i < $ni; $i++){
        if($datas[$i]['user_reference_id'] == $parent){

          $tree .= '<li>
                            <div>
                                     <a href="/tree/create/'.$datas[$i]['id'].'">
                                <input type="checkbox">'.$datas[$i]->user->name.'</div>';
          $tree .= $this->generatePageTree($datas, $datas[$i]['user_id'], $limit++);
          $tree .= '</a></li>';
        }

      }
      $tree .= '</ul>';
      return $tree;

      }


}
