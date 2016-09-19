<?php

namespace CodeProject\Http\Middleware;

use Closure;
use CodeProject\Repositories\ProjectRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class CheckProjectOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($request, Closure $next)
    {
        $userId = Authorizer::getResourceOwnerId();
        $projectId = $request->project;

        if($this->repository->isOwner($projectId, $userId) == false){
            return response(['error' => 'Access Forbidden']);
        }

        return $next($request);
    }
}
