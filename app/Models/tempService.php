<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class tempService extends Model
{
    use HasFactory, Notifiable;
    protected $primaryKey = 'ts_id';

    public function providers(){
        return $this->belongsTo('App\Models\Provider');
    }
}
