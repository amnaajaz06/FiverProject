<?php

namespace App;
use App\Skill;
use Illuminate\Database\Eloquent\Model;
use App\Award;
class Seller extends Model
{
     protected $fillable = ['seller_experiance', 'seller_description', 'seller_NIC' ];
     public function skills()
	    {
	        return $this->hasMany(Skill::class);
	    }
	 public function awards()
	    {
	        return $this->hasMany(Award::class);
	    }
}
