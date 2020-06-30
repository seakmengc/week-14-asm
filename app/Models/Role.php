<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public static $adminName = 'admin';

    public static $editorName = 'editor';

    public function users()
    {
        return $this->hasMany(User::class)->using(UserRole::class);
    }
}
