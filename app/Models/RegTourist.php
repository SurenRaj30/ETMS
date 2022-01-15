<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegTourist extends Model
{
    use HasFactory;
    protected $primaryKey = 'rt_id';

    protected $fillable = [
        'rt_name',
        'rt_contact',
        'start_date',
        'end_date',
        'c_package'
    ];
    public $timestamps = false;

    public function provider(){
        return $this->belongsTo('App\Models\Provider');
    }
}
