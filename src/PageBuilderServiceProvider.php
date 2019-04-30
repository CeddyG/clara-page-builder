<?php
namespace CeddyG\ClaraPageBuilder;

use Illuminate\Support\ServiceProvider;

use Event;

/**
 * Description of EntityServiceProvider
 *
 * @author CeddyG
 */
class PageBuilderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishesConfig();
		$this->publishesTranslations();
        $this->loadRoutesFrom(__DIR__.'/routes.php');
		$this->publishesView();
        
        Event::subscribe(\CeddyG\ClaraPageBuilder\Listeners\PageCategoryTextSubscriber::class);
        Event::subscribe(\CeddyG\ClaraPageBuilder\Listeners\PageSubscriber::class);
    }
    
    /**
	 * Publish config file.
	 * 
	 * @return void
	 */
	private function publishesConfig()
	{
		$sConfigPath = __DIR__ . '/../config';
        if (function_exists('config_path')) 
		{
            $sPublishPath = config_path();
        } 
		else 
		{
            $sPublishPath = base_path();
        }
		
        $this->publishes([$sConfigPath => $sPublishPath], 'clara.page.config');  
	}
	
	private function publishesTranslations()
	{
		$sTransPath = __DIR__.'/../resources/lang';

        $this->publishes([
			$sTransPath => resource_path('lang/vendor/clara-page'),
			'clara.page.trans'
		]);
        
		$this->loadTranslationsFrom($sTransPath, 'clara-page');
    }

	private function publishesView()
	{
        $sResources = __DIR__.'/../resources/views';

        $this->publishes([
            $sResources => resource_path('views/vendor/clara-page'),
        ], 'clara.page.views');
        
        $this->loadViewsFrom($sResources, 'clara-page');
	}

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/clara.page.php', 'clara.page'
        );
        
        $this->mergeConfigFrom(
            __DIR__ . '/../config/clara.navbar.php', 'clara.navbar'
        );
        
        $this->mergeConfigFrom(
            __DIR__ . '/../config/clara.page-category.php', 'clara.page-category'
        );
    }
}
