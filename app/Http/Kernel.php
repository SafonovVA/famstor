<?php

namespace App\Http;

use App\Http\Middleware\{
    TrustHosts,
    VerifyCsrfToken,
    TrustProxies,
    TrimStrings,
    RedirectIfAuthenticated,
    NiceArtisan,
    EncryptCookies,
    CheckForMaintenanceMode,
    Authenticate};
use Fruitcake\Cors\HandleCors;
use Illuminate\Auth\Middleware\{
    AuthenticateWithBasicAuth,
    Authorize,
    EnsureEmailIsVerified,
    RequirePassword};
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\{
    ConvertEmptyStringsToNull,
    ValidatePostSize};
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Routing\Middleware\{
    SubstituteBindings,
    ThrottleRequests,
    ValidateSignature};
use Illuminate\Session\Middleware\{
    StartSession,
    AuthenticateSession};
use Illuminate\View\Middleware\ShareErrorsFromSession;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        //TrustHosts::class,
        TrustProxies::class,
        HandleCors::class,
        CheckForMaintenanceMode::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            //AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'auth.basic' => AuthenticateWithBasicAuth::class,
        'artisan' => NiceArtisan::class,
        'bindings' => SubstituteBindings::class,
        'cache.headers' => SetCacheHeaders::class,
        'can' => Authorize::class,
        'guest' => RedirectIfAuthenticated::class,
        'password.confirm' => RequirePassword::class,
        'signed' => ValidateSignature::class,
        'throttle' => ThrottleRequests::class,
        'verified' => EnsureEmailIsVerified::class,
    ];
}
