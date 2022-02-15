<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'title', 'text', 'slug',];
    protected $appends = ['teaser'];



    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The tags that belong to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    
    /**
     * comments that belong to the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    /**
     * A user can have file
    **/
    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }
    public function getAvatarAttribute()
    {
        if ( $file = $this->file ) {
            return asset('img/users/'. $this->id .'/'. $file->filename );
        }else{
            return asset('img/users/default/1.png');
        }   
    }

    // SET

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucfirst(str_replace('.', '', $value));
        $this->attributes['slug'] = Str::slug($value);
    }   
    // GET
   
    public function getUpdatedAtAttribute($value)
    {
        return date('Y-m-d', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('j.m.Y, G:i', strtotime($value));
    }
    
    public function getTeaserAttribute()
    {
        return Str::words( "$this->text" , 60, '...');
    }

}
