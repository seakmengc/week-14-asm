<?php

namespace App\Models;

use App\Mail\CommentCreatedMail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;

/**
 * Class Comment
 * @package App\Models
 * @version June 28, 2020, 9:01 am UTC
 *
 * @property \App\Models\Post $post
 * @property integer $post_id
 * @property string $name
 * @property string $comment
 */
class Comment extends Model
{
    public $fillable = [
        'post_id',
        'name',
        'comment'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'post_id' => 'integer',
        'name' => 'string',
        'comment' => 'string'
    ];

    // protected $dates = ['created_at', 'updated_at'];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'post_id' => 'required|exists:posts,id',
        'name' => 'required|max:255',
        'comment' => 'required|max:255'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class, 'post_id');
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (Comment $comment) {
            //send to creator
            Mail::to($comment->post->author)->queue(new CommentCreatedMail($comment));

            //send to admin users
            $admin = Role::where('name', Role::$adminName)->first();
            Mail::to($admin->users)->queue(new CommentCreatedMail($comment));
        });
    }
}
