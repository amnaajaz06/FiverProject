<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['description','rate','level_of_experience','category','seller_id'];
    public function skillimages()
	    {
	        return $this->hasMany(SkillImage::class);
	    }
}
