<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use willvincent\Rateable\Rateable;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    use Rateable;

    protected $primaryKey = 's_id';

    protected $fillable = [
        's_type',
        's_name',
        'maxTourist',
        's_price',
        's_address',
        'days',
        'start_time',
        'end_time',
        's_overview',
        'name',
        'image_path',
    ];
    public $timestamps = false;

    public function providers(){
        return $this->belongsTo('App\Models\Provider');
    }

    public function rating()
{
  return $this->hasMany(Rating::class);
}

    



}
