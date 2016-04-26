<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Outbox extends Model
{
    protected $table = 'outbox';
    public $timestamps = false;

    protected $fillable = [
    	'InsertIntoDB',
    	'SendingDateTime',
    	'DestinationNumber',
    	'Coding',
    	'Class',
    	'CreatorID',
    	'SenderID',
    	'TextDecoded',
    	'RelativeValidity',
    	'DeliveryReport',
    ];

    public static function boot() {

        parent::boot();
        static::saving(function($pesan) {
            $pesan->InsertIntoDB = Carbon::now()->toDateTimeString();
            $pesan->SendingDateTime = Carbon::now()->toDateTimeString();
        });
    }
}
