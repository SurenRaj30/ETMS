<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class tempProvider extends Model
{
    use HasFactory, Notifiable;
    protected $primaryKey = 'id';
    //protected $table= 'temp_providers';
    protected $fillable = [
       'name', 
       'email', 
       'password',
       'street',
       'city',
       'state',
       'postcode',
       'p_no',
       'swa',
       'ic',
       'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function users(){
        return $this->belongsTo('App\Models\Admin');
    }

   

}
