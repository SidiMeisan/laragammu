<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    protected $table = 'inbox';
    public $timestamps = false;

    public function contact_phone()
    {
    	return $this->belongsTo('App\Models\ContactPhone', 'SenderNumber', 'phone');
    }
}
