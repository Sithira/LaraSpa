<?php

namespace App\Providers;

use Adaojunior\Passport\SocialUserResolverInterface;
use App\Auth\SocialAccountResolver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // register passport routes.
        Passport::routes();
    }

    public function register()
    {
        parent::register();

        // register the resolver for key value pair
        $this->app->singleton(SocialUserResolverInterface::class, SocialAccountResolver::class);
    }
}
