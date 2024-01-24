<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_file';
    protected $guarded = ['id_file'];

    public function user() {
        return $this->belongsTo(User::class, 'id_pengirim', 'id_user');
    }

    public function file()
    {
        return $this->belongsTo(File::class, 'id_file', 'id_file');
    }
}
