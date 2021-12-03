<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'issue_id',
        'name'
    ];

    public function image() {
        return $this->belongsTo(Issue::class, 'issue_id', 'id');
    }
}
