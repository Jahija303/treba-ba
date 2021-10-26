<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'issue_id',
        'issue_comment_id',
        'comment_reply_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function issue(): BelongsTo
    {
        return $this->belongsTo(Issue::class, 'issue_id');
    }

    public function comment(): BelongsTo
    {
        return $this->belongsTo(IssueCOmment::class, 'issue_comment_id');
    }

    public function reply(): BelongsTo
    {
        return $this->belongsTo(CommentReply::class, 'comment_reply_id');
    }
}
