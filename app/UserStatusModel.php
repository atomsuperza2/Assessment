<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStatusModel extends Model
{
   protected $table = 'status';
   protected $guarded = [ ];

   public function users() {
 	   return $this->hasMany('App\User', 'user_id', 'id');
   }
}
