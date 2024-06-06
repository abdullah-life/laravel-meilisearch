<?php

namespace AbdullahK\LaravelMeilisearch;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AbdullahK\LaravelMeilisearch\Skeleton\SkeletonClass
 */
class LaravelMeilisearchFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-meilisearch';
    }
}
