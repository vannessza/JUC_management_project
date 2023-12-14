<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vendor extends Model
{
    use HasFactory;

    protected $table = "vendor";
    protected $fillable = ['nama_perusahaan', 'alamat', 'nomor_telepon', 'alamat_email', 'nama_kontak', 'image'];
    /**
     * Summary of projects
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projects(){
    return $this->belongsToMany(Projects::class, 'projects_vendor','vendor_id', 'project_id');
}

}
