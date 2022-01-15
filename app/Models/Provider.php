<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Provider extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;

    use Notifiable;


        protected $primaryKey = 'id';

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

        public function services(){
            return $this->hasMany('App\Models\Service', 'user_id');
        }

        public function RegTourists(){
            return $this->hasMany('App\Models\RegTourist', 'user_id');
        }

        public function bookings(){
            return $this->hasMany('App\Models\Booking', 'id');
        }

        public function t_services(){
            return $this->hasMany('App\Models\tempService', 'user_id');
        }
}
