<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class ProjectMembers extends Model implements Transformable
{
    use TransformableTrait;
    public $timestamps = false;
    protected $fillable = [
        'project_id',
        'member_id'
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function member()
    {
        return $this->belongsTo(User::class);
    }
    public function user()
    {
        return $this->hasMany(User::class);
    }


}
