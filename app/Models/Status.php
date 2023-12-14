<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = "status";
    
    use HasFactory;

    protected $fillable = ['Tanggal', 'update', 'comment', 'project_id'];

    // public function project(){
    //     return $this->belongsTo(Projects::class, 'prioritas_id', 'id');
    // }
    public function project()
{
    return $this->belongsTo(Projects::class, 'project_id');
}
}
