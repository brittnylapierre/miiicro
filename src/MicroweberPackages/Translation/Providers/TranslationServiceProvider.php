<?php
namespace MicroweberPackages\Translation\Providers;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Schema;
use Illuminate\Translation\TranslationServiceProvider as IlluminateTranslationServiceProvider;
use MicroweberPackages\Translation\Models\Translation;
use MicroweberPackages\Translation\TranslationManager;
use MicroweberPackages\Translation\Translator;

class TranslationServiceProvider extends IlluminateTranslationServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * This is an example how to add namespace to your package
         * andd how to call it with trans function
         *
         * Example:
         *  trans('translation::all.name')
         */
        Lang::addNamespace('translation', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'resources/lang');

        $this->loadRoutesFrom(dirname(__DIR__) . '/routes/web.php');

        if (mw_is_installed()) {
            if (!Schema::hasTable('translations')) {
                app()->mw_migrator->run([
                    dirname(__DIR__) . DIRECTORY_SEPARATOR . 'migrations'
                ]);
            }

            $this->app->terminating(function () {
                $getNewTexts = app()->translator->getNewTexts();
                if (!empty($getNewTexts)) {
                    foreach ($getNewTexts as $text) {

                        $text['key'] = trim($text['key']);
                        $text['group'] = trim($text['group']);
                        $text['namespace'] = trim($text['namespace']);
                        $text['locale'] = trim($text['locale']);

                        $findTranslation = Translation::where('namespace', $text['namespace'])
                            ->where('group', $text['group'])
                            ->whereRaw("BINARY `key`= ?",[$text['key']])
                            ->where('locale', $text['locale'])->first();
                        if ($findTranslation == null) {
                            Translation::insert($text);
                        }
                    }
                    try {
                        clearcache();
                    } catch (\Exception $e) {
                        //
                    }
                }
            });
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerLoader();

        $this->app->singleton('translator', function ($app) {
            $loader = $app['translation.loader'];

            // When registering the translator component, we'll need to set the default
            // locale as well as the fallback locale. So, we'll grab the application
            // configuration so we can easily get both of these values from there.
            $locale = $app['config']['app.locale'];

            $trans = new Translator($loader, $locale);

            $trans->setFallback($app['config']['app.fallback_locale']);

            return $trans;
        });
    }

    protected function registerLoader()
    {
        if (mw_is_installed()) {
            $this->app->singleton('translation.loader', function ($app) {
                return new TranslationManager($app['files'], $app['path.lang']);
            });
        }
    }
}