<?php

namespace WebCoding\Providers;

use WebCoding\Models\Activity;
use WebCoding\Models\ActivityComment;
use WebCoding\Policies\ActivityPolicy;
use WebCoding\Policies\ActivityCommentPolicy;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Activity::class         =>  ActivityPolicy::class,
        ActivityComment::class  =>  ActivityCommentPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

        //
    }
}
