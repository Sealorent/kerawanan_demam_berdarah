<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GA extends Model
{
    use HasFactory;
    protected $table = 'tb_ga';
    protected $fillable = ['id_rule'];
}
