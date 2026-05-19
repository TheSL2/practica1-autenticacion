<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Auditable;;

class Tag extends Model
{
    use Auditable;
    use HasFactory;

    protected $fillable = ['name'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}