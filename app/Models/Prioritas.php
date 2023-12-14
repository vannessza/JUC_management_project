<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prioritas extends Model
{
    use HasFactory;
    protected $table = "prioritas";
    protected $primarykey = "prioritas_id";
    public function projects(){
        return $this->hasMany(Projects::class, 'prioritas_id', 'id');
    }
}
