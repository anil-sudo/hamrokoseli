<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->extend(
            HtmlSanitizerConfig::class,
            fn (HtmlSanitizerConfig $config): HtmlSanitizerConfig => $config
                ->allowAttribute('data-scroll', allowedElements: '*')
                ->allowAttribute('data-scroll-speed', allowedElements: '*')
                ->allowAttribute('data-scroll-position', allowedElements: '*')
                ->allowAttribute('data-scroll-offset', allowedElements: '*')
                ->allowAttribute('data-scroll-direction', allowedElements: '*')
                ->allowAttribute('data-scroll-delay', allowedElements: '*')
                ->allowAttribute('data-scroll-call', allowedElements: '*')
                ->allowAttribute('data-src', allowedElements: '*')
                ->allowAttribute('data-srcset', allowedElements: '*')
                ->allowAttribute('data-sizes', allowedElements: '*'),
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
        $this->configureSecureUrls();
        $this->configureDatabase();
    }

    protected function configureDatabase()
    {
        Model::automaticallyEagerLoadRelationships();
    }

    protected function configureSecureUrls()
    {
        // Determine if HTTPS should be enforced
        $enforceHttps = $this->app->environment(['production', 'staging'])
            && ! $this->app->runningUnitTests();

        // Force HTTPS for all generated URLs
        URL::forceHttps($enforceHttps);

        // Ensure proper server variable is set
        if ($enforceHttps) {
            URL::forceScheme('https');
            $this->app['request']->server->set('HTTPS', 'on');
        }
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
