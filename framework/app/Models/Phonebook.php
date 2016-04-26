<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Input, Carbon\Carbon;
class Phonebook extends Model
{
    protected $table = 'contact';
    public $timestamps = false;

    protected $fillable = [
    	'nama',
    	'alamat',
    	'birthday',
    	'umur',
    	'email'
    ];

    public static function boot() {

        parent::boot();
        static::saving(function($phonebook) {
            $phonebook->umur = date('Y') - date_format(date_create(Input::get('birthday')), 'Y');
        });
    }
}
