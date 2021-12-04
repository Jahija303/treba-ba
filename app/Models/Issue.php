<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class , "city_id");
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class , "category_id");
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class , "district_id");
    }

    public function comments(): HasMany
    {
        return $this->hasMany(IssueComment::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function images(){
        return $this->hasMany(Image::class, 'issue_id');
    }
}
