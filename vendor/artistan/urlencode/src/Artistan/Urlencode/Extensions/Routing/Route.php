<?php
/**
 * User: cpeterson
 * Date: 2013
 */
namespace Artistan\Urlencode\Extensions\Routing;

use Illuminate\Routing\Route as Rt;
use Illuminate\Http\Request;
use Artistan\Urlencode\Extensions\Routing\Matching\UriValidator;
use Illuminate\Routing\Matching\HostValidator;
use Illuminate\Routing\Matching\MethodValidator;
use Illuminate\Routing\Matching\SchemeValidator;

class Route extends Rt
{
    /**
     * Get the parameter matches for the path portion of the URI.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function bindPathParameters(Request $request)
    {
        preg_match($this->compiled->getRegex(), '/'.$request->path(), $matches);
        return array_map('rawurldecode', $matches);
    }

    /**
     * Get the route validators for the instance.
     *
     * @return array
     */
    public static function getValidators()
    {
        if (isset(static::$validators)) return static::$validators;

        // To match the route, we will use a chain of responsibility pattern with the
        // validator implementations. We will spin through each one making sure it
        // passes and then we will know if the route as a whole matches request.
        return static::$validators = array(
            new MethodValidator, new SchemeValidator,
            new HostValidator, new UriValidator,
        );
    }
}