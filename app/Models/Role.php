<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Auditable;

class Role extends Model
{
    use Auditable;
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles');
    }
}