<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    /**
     * Get the parent imageable model (user or post).
     */
    public function fileable()
    {
        return $this->morphTo();
    }
}
