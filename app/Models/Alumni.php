<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'alumni';

    protected $fillable = [
        'name',
        'id_number',
        'course',
        'batch',
        'photo_url',
    ];

    protected $casts = [
        'batch' => 'integer',
    ];
}

