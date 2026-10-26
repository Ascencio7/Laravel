<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'marcas';

    protected $primaryKey = 'codigo';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = true;
}
