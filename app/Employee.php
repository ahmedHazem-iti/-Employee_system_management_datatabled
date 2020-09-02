<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'f_name', 'l_name','job','location_lng','location_lat','image','status'
       ];
}
