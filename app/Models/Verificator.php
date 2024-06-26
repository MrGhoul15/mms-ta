<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verificator extends Model
{
    use HasFactory;

    protected $table = 'verificators';

    protected $casts =[
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];

    protected $fillable = [
        'signature_code', 'user_id', 'name', 'position', 'signature_image'
    ];
}
