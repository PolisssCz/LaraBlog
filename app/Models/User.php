<?php

namespace App\Models;

use App\Models\File;
use App\Models\Post;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setNameAttribute($value)
    {
        return $this->attributes['name'] = ucfirst($value);
    }

    /**
     * Get all of the posts for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class)->latest("created_at");;
    }
    /**
     * A user can have file
    **/
    public function file()
    {
        return $this->morphOne(File::class, 'fileable')->latest();
    }
    public function getAvatarAttribute()
    {
        if ( $file = $this->file ) {
            return asset('img/users/'. $this->id .'/'. $file->filename );
        }else{
            return asset('img/users/default/1.png');
        }   
    }
    /**
     * in case of setting Czech localization rename rank
    **/
    public function getRankAttribute($value)
    {
        switch ( App::getLocale()) {
            case 'cz':
                if ($value == 'User') {
                    $value_e = "Uživatel";
                    return $value_e;
                }else{
                    return $value;
                }
                break;
            
            default:
                return $value;
        }
    }

}
