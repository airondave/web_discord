<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'submissionsgg';
    protected $fillable = ['discord_username', 'discord_id', 'proof_path', 'status', 'role_id', 'desired_role', 'submission_type'];

    // Relationship with role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
