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
        'user_id'
    ];
    public function projects(){
        return $this->hasMany(Project::class,'id','project_id');
    }
    public function users(){
        return $this->hasMany(User::class,'id','user_id');
    }
}
