<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPhone extends Model
{
    protected $table = 'contact_phone';
    public $primaryKey = 'phone';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['contact_id', 'phone', 'status'];

    public function contact()
    {
    	return $this->belongsTo('App\Models\Phonebook', 'contact_id', 'id');
    }

    public function inbox()
    {
    	return $this->hasMany('App\Models\Inbox', 'SenderNumber', 'phone');
    }
}
