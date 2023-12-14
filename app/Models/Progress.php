<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;
    protected $table = "status_progress";
    protected $primarykey = "status_progress_id";
    public function projects(){
        return $this->hasMany(Projects::class, 'status_progress_id', 'id');
    }
}
