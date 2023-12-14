<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Projects extends Model
{
    use HasFactory;
    protected $table = "projects";
    protected $fillable = ['nama_project', 'detail_project', 'vendor_id', 'platform', 'prioritas_id', 'pic', 'target', 'status_progress_id'];
    public function user(): BelongsToMany{
        return $this->belongsToMany(User::class);
    }

    /**
     * Summary of vendor
     * @return BelongsToMany
     */
    public function vendor(){
        return $this->belongsToMany(Vendor::class, 'projects_vendor', 'project_id', 'vendor_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'User_projects', 'project_id', 'user_id')->withTimestamps();
    }

    public function removeUser(User $user)
    {
        $this->users()->detach($user->id);
    }

    // public function isOwnedByLoggedInUser(): bool
    // {
    //     return $this->user_id === auth()->user()->id;
    // }

    public function status(){
        return $this->hasMany(Status::class, 'project_id')->latest();;
    }
    public function prioritas(){
        return $this->belongsTo(Prioritas::class, 'prioritas_id', 'id');
    }
    public function progress(){
        return $this->belongsTo(Progress::class, 'status_progress_id', 'id');
    }
    public function latestUpdate()
    {
        return $this->hasOne(Status::class)->latest();
    }
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'id_owner');
    }
    
}
