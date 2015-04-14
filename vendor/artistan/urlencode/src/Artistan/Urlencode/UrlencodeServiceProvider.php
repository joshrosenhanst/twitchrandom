<?php namespace Artistan\Urlencode;

use Illuminate\Support\ServiceProvider;
use Artistan\Urlencode\Extensions\Routing\Router as Router;
use Artistan\Urlencode\Extensions\Routing\UrlGenerator as UrlGenerator;

class UrlencodeServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('artistan/urlencode');

        // override the routing to allow encoded slashes in the urls.
        $this->app['router'] = $this->app->share(function($app)
        {
            $router = new Router($app['events'], $app);
            return $router;
        });
        $this->app['url'] = $this->app->share(function($app)
        {
            $routes = $app['router']->getRoutes();
            return new UrlGenerator($routes, $app->rebinding('request', function($app, $request)
            {
                $app['url']->setRequest($request);
            }));
        });
    }

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
