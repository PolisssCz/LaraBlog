<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    
    // do not fill in the timestamps when inserting
    public $timestamps = false;

    // field to be filled in
    protected $fillable = ['tag','slug',];

    // SET

    public function setTagAttribute($value)
    {
        $this->attributes['tag'] = ucfirst(($value));
        $this->attributes['slug'] = Str::slug($value);
    }   

    /**
     * The posts that belong to the Tag
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class)->latest("created_at");
    }
}
