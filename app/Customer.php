<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;
    protected $table = 'customers';
    protected $fillable = [
        'id', 
        'name', 
        'email',
        'contact_number'
    ];
}
