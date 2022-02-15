<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTags extends Model
{
    use HasFactory;
    
    //use 'variable' table 
    protected $table = 'post_tag';

    // do not fill in the timestamps when inserting
    public $timestamps = false;

    // field to be filled in
    protected $fillable = ['post_id','tag_id'];
}
