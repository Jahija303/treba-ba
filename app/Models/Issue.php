<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "city_id",
        "category_id",
        "district_id",
        "latitude",
        "longitude",
        "title",
        "description",
        "priority",
        "status"
    ];

    public function user(){
        return $this->belongsTo(User::class, "user_id");
    }

    public function city(){
        return $this->belongsTo(City::class , "city_id");
    }

    public function category(){
        return $this->belongsTo(Category::class , "category_id");
    }

    public function district(){
        return $this->belongsTo(District::class , "district_id");
    }
}
