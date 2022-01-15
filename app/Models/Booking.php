<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $primaryKey = 'id'; 
    protected $hidden = ['provider_id'];

    protected $fillable = [

        's_name', 'start', 'end', 'title'

    ];

    public function provider()
    {
        return $this->belongsTo('App\Models\Provider');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
}





