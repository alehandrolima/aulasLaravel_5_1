<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'owner_id',
        'client_id',
        'name',
        'description',
        'progress',
        'status',
        'due_date'
    ];

    public function notes()
    {
        return $this->hasMany(ProjectNote::class)->orderBy('created_at', 'desc');
    }

    public function tasks()
    {
        return $this->hasMany(ProjectTask::class)->orderBy('id', 'desc');;
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members', 'project_id', 'member_id')->withPivot('id');
    }

    public function files()
    {
        return $this->hasMany(ProjectFile::class);
    }
}
