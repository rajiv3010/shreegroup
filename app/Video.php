<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    Protected $fillable=['name','video_url','short_desc','status'];
}
