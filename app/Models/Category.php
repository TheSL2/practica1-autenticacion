<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Auditable;

class Category extends Model
{
    use Auditable;
    use HasFactory;
    
    protected $fillable = ['name', 'description'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}