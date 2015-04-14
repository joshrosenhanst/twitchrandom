<?php
/**
 * User: cpeterson
 * Date: 2013
 */
namespace Artistan\Urlencode\Extensions\Routing;

use Illuminate\Routing\UrlGenerator as UrlGen;

class UrlGenerator extends UrlGen
{
    /**
     * Get the URL for a given route instance.
     *
     * @param  \Illuminate\Routing\Route  $route
     * @param  array  $parameters
     * @param  bool  $absolute
     * @return string
     */
    protected function toRoute($route, array $parameters, $absolute)
    {
        $domain = $this->getRouteDomain($route, $parameters);
        // rawurlencode the parameters, the rest should be good
        // this will allow slashes in the parameters!
        $parameters = array_map(array($this,'encode'), $parameters);

        $uri = $this->trimUrl(
                $root = $this->replaceRoot($route, $domain, $parameters),
                $this->replaceRouteParameters($route->uri(), $parameters)
            ).$this->getRouteQueryString(array_map(array($this,'decode'), $parameters));

        return $absolute ? $uri : '/'.ltrim(str_replace($root, '', $uri), '/');
    }

    /**
     * encode callback
     * don't decode multi-dimensional arrays, they are query string params
     *
     * @param $param
     * @return string
     */
    function encode($param){
        if(!is_array($param)){
            return rawurlencode($param);
        }

        return $param;
    }

    /**
     * decode callback
     * don't decode multi-dimensional arrays, they are query string params
     *
     * @param $param
     * @return string
     */
    function decode(&$param){
        if(!is_array($param) && !is_object($param)){
            return rawurldecode($param);
        }

        return $param;
    }
}