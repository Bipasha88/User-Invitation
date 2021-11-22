<?php

namespace App\Providers;

use App\Repositories\Base\BaseRepository;
use App\Repositories\Base\IBaseRepository;
use App\Repositories\Invite\IInviteRepository;
use App\Repositories\Invite\InviteRepository;
use App\Repositories\User\IUserRepository;
use App\Repositories\User\UserRepository;
use App\Services\Invite\IInviteService;
use App\Services\Invite\InviteService;
use App\Services\Mail\IMailService;
use App\Services\Mail\MailService;
use App\Services\User\IUserService;
use App\Services\User\UserServices;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IBaseRepository::class,BaseRepository::class);
        $this->app->bind(IInviteRepository::class,InviteRepository::class);
        $this->app->bind(IUserRepository::class,UserRepository::class);
        $this->app->bind(IInviteService::class,InviteService::class);
        $this->app->bind(IMailService::class,MailService::class);
        $this->app->bind(IUserService::class,UserServices::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
