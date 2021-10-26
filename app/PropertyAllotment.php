<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class PropertyAllotment extends Model
{
 protected $fillable = [
'user_key','upgrade_history_id', 'project_name', 'phase_number', 'unit_no', 'plot_1', 'plot_2', 'plot_size', 'plot_rate'
 ];


 public function haveRegistry()
    {
        return $this->belongsTo('App\RegistryForm','id','property_allotment_id');
    }
  
}
