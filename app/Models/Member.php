<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['title','subtitle', 'photo', 'ceo', 'facebook','twitter','linkedin', 'details', 'company_name'];

    public $timestamps = false;


}