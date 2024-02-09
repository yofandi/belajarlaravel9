<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDelete;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [
        'title',
        'content',
        'bookmark',
        'detail',
    ];

    // boot adalah sintak bawaan dari laravel sendiri yang berfungsi untuk memicu atau mentrigger event2 (created,updated,deleted,saved,trashed,,forceDeteled,restored) yang akan dituliskan//

    public static function boot() {
        parent::boot();

        // dilakukan sebelum data dimasukan
        static::creating(function ($post) {
            $post->slug = str_replace(' ','-',$post->title);
        });
    }
    
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function countComments() {
        return $this->comments()->count();
    }

    public function scopeActive($query) {
        return $query->where('active', true);
    }
}
