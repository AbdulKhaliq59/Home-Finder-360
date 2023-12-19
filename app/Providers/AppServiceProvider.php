<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Blade::directive("errorClass", function ($expression) {
            return "<?php echo \$errors->has($expression) ? 'is-invalid' : ''; ?>";
        });
        Validator::extend("password_match", function ($attribute, $value, $parameters, $validator) {
            return $value === $validator->getData()[$parameters[0]];
        });
        Validator::replacer("password_match", function ($message, $attribute, $rule, $parameters) {
            return str_replace(':other', $parameters[0], $message);
        });
    }
}
