<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Tags\HasTags;


class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;
    use HasTags;
    protected $fillable = ['title','body','image'];
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class,'creator_id','id');
    }
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
