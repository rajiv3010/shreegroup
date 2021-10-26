<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
class Content extends Model
{
    protected $guarded = [];
    use NodeTrait;

}
