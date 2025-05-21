<?php

namespace YassineAs\CasAuth\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static bool isAuthenticated()
 * @method static array getAttributes()
 * @method static string|null getUser()
 * @method static mixed authenticate()
 * @method static mixed logout(string|null $url = null)
 *
 * @see \YassineAs\CasAuth\CasAuthManager
 */ 
class CasAuth extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cas-auth';
    }
}
