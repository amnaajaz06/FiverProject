<?php

namespace App;
use App\Skill;
use Illuminate\Database\Eloquent\Model;
use App\Award;
class Seller extends Model
{
     protected $fillable = ['profile_picture','location', 'seller_description', 'street_address','unit_number','city','state','zip_code','birthdate','about_us' ];
     public function skill()
	    {
	        return $this->hasMany(Skill::class);
	    }
	 public function awards()
	    {
	        return $this->hasMany(Award::class);
	    }
}
