<?php

namespace YassineAs\CasAuth;

use Illuminate\Contracts\Foundation\Application;
use Subfission\Cas\Facades\Cas;

class CasAuthManager
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * Create a new CasAuthManager instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Check if user is authenticated via CAS.
     *
     * @return bool
     */
    public function isAuthenticated()
    {
        Cas::authenticate();
        return Cas::isAuthenticated();
    }

    /**
     * Get CAS user attributes.
     *
     * @return array
     */
    public function getAttributes()
    {
        return Cas::getAttributes();
    }

    /**
     * Get CAS user.
     *
     * @return string|null
     */
    public function getUser()
    {
        return Cas::user();
    }

    /**
     * Force CAS authentication.
     *
     * @return mixed
     */
    public function authenticate()
    {
        return Cas::authenticate();
    }

    /**
     * Logout from CAS.
     *
     * @param string|null $url
     * @return mixed
     */
    public function logout($url = null)
    {
        return Cas::logout($url);
    }
}