<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\Tags\Tag;
use Spatie\Tags\HasTags;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, HasTags;

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'slug',
        'thumbnail',
        'is_published',
        'published_at',
        'user_id',
        'excerpt',
        'author_id',
    ];

    // Automatically set user_id for new posts
    protected static function booted()
    {
        static::creating(function ($post) {
            // If user_id is not set, assign the currently authenticated user
            if (!$post->user_id) {
                $post->user_id = auth()->id(); // Get the ID of the currently authenticated user
            }

            // If slug is not provided, generate it from the title
            if (!$post->slug) {
                $post->slug = Str::slug($post->title);
            }
        });

        // Automatically update the slug when the title is changed
        static::saving(function ($post) {
            if ($post->isDirty('title')) {
                $post->slug = Str::slug($post->title); // Update the slug when title changes
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class); // Pastikan ini ada
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Pastikan ini ada
    }

    public function getPublishedAtAttribute($value)
    {
        return Carbon::parse($value); // Mengonversi ke objek Carbon
    }

    public function getRouteKeyName()
    {
        return 'slug'; // Use 'slug' as the route key
    }
    public function author()
    {
        return $this->belongsTo(Author::class);
    }


    public static function getUsedTags()
    {
        return Tag::whereIn('id', function ($query) {
            $query->select('taggables.tag_id')
                ->from('taggables')
                ->join('posts', 'taggables.taggable_id', '=', 'posts.id')
                ->where('taggables.taggable_type', self::class) // Ambil hanya tag yang dipakai Post
                ->where('posts.is_published', 1); // Hanya post yang is_published = 1
        })->get();
    }

}
