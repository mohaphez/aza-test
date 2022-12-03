<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StarLog extends Model
{
    protected $fillable = ['user_id', 'post_id', 'star'];
    use HasFactory;
    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            $model->post->increment('star', $model->star);
        });
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
