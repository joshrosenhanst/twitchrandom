Urlencode for Laravel 4
==============

Overrides the default routing in Laravel 4 to allow all characters to be encoded including slashes!

### Composer Configuration

Include the artistan urlencode package as a dependency in your `composer.json` [Packagist](https://packagist.org/packages/artistan/urlencode):

    "artistan/urlencode": "1.0.*"

### Installation

Once you update your composer configuration, run `composer install` to download the dependencies.

Add a ServiceProvider to your providers array in `app/config/app.php`:

	'providers' => array(

		'Artistan\Urlencode\UrlencodeServiceProvider',

	)

### Warning

    Ensure all your routes are properly rawurlencoded!

    This package will actually break your routing IF you do not have valid urls in your routes.

### Laravel Bug Fix

    ([Bug] urlencoded slashes in routing parameters)[https://github.com/laravel/framework/pull/4338]
    Current routes do not allow for urlencoded slashes in the paths.
    This is problematic when trying to create ecommerce solutions with partnumbers in the routes
    since many part numbers have slashes in them. There are also quite a few
    manufacturers with slashes in their names and or brands. This package provides
    the functionality to allow an uri to have encoded slashes, and other characters,
    in the (routes)[http://laravel.com/docs/routing] and also to
    (create routes with those parameters)[http://laravel.com/docs/routing#route-parameters].

     An example url may be...

        https://stage.test.com/part/Cisco%20Systems%2C%20Inc/CISCO2851-SRST%2FK9

        Route::any('/part/{mfg}/{part}',
            array(
                'uses' =>'Vendorname\Package\Controllers\Hardware\PartController@part',
                'as' => 'part_page'
            )
        );


### Usage

    With that said it WILL allow all characters to be rawurlencoded as parameters in your routes without breaking parameters and/or routes.

