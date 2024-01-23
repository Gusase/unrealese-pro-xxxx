<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class User extends Model implements Authenticatable
{
    use AuthenticatableTrait, HasFactory;

    protected $primaryKey = 'id_user';
    protected $guarded = ['id_user'];

    public function files() {
        return $this->hasMany(File::class, 'id_user', 'id_user');
    }
}
