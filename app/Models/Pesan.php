<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pesan';
    protected $guarded = ['id_pesan'];

    public function user() {
        return $this->belongsTo(User::class, 'id_pengirim', 'id_user');
    }

    public function file()
    {
        return $this->belongsTo(File::class, 'id_file', 'id_file');
    }
}
