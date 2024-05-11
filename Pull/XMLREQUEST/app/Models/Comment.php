<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Comment extends Model
{
    use HasFactory;
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
    public function users(): MorphToMany
    {
        return $this->morphedByMany(User::class, 'commentable');
    }
}
