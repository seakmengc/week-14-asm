<?php

namespace App\Models;

use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Mail\PostCreationMail;
use App\Mail\PostApprovedMail;

/**
 * @SWG\Definition(
 *      definition="Post",
 *      required={"title", "category_id", "creator_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int64"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *     @SWG\Property(
 *          property="category",
 *          description="category",
 *          type="category",
 *          ref="#/definitions/Category"
 *      ),
 *     @SWG\Property(
 *          property="author",
 *          description="author",
 *          type="string"
 *      ),
 *     @SWG\Property(
 *          property="content",
 *          description="content",
 *          type="string"
 *      ),
 *     @SWG\Property(
 *          property="creator_id",
 *          description="creator_id",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Post extends Model
{
    protected $fillable = ['category_id', 'title', 'content'];

    protected $with = ['category', 'author'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Post $post) {
            $post->author()->associate(auth()->user());
        });

        static::created(function (Post $post) {
            //send to admin users
            $admin = Role::where('name', Role::$adminName)->first();
            Mail::to($admin->users())->queue(new PostCreationMail($post));
        });

        static::updated(function (Post $post) {
            if ($post->isDirty('is_approved') and $post->is_approved) {
                //send to post author
                Mail::to($post->author)->queue(new PostApprovedMail($post));
            }
        });
    }
}
