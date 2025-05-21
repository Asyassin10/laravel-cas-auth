<?php

namespace YassineAs\CasAuth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use YassineAs\CasAuth\Facades\CasAuth;

class CasAuthController
{
    /**
     * Redirect the user to the CAS login page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login()
    {
        // Construct the CAS login URL
        $casHostname = config('cas.cas_hostname');
        $loginUri = config('cas.server_login_uri', '/cas/login');
        $service = config('cas.cas_service');
        
        $loginUrl = "https://{$casHostname}{$loginUri}?service=" . urlencode($service);
        
        return redirect()->away($loginUrl);
    }
    
    /**
     * Handle the CAS callback after successful authentication.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleCallback(Request $request)
    {
        if (CasAuth::isAuthenticated()) {
            // User successfully authenticated with CAS
            
            // You could create or update a local user here if needed
            // $user = User::updateOrCreate(['cas_username' => Cas::user()], [...]);
            // Auth::login($user);
            
            // Redirect to the intended URL or home page
            return redirect()->intended(config('cas.redirect_after_login', '/'));
        }
        
        // Authentication failed
        return redirect()->route('login')->with('error', 'CAS authentication failed');
    }
    
    /**
     * Log the user out.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Perform Laravel logout
        Auth::logout();
        
        // Clear session
        Session::invalidate();
        Session::regenerateToken();
        
        // Clear cookies
        $cookies = $request->cookies->keys();
        foreach ($cookies as $cookie) {
            Cookie::queue(Cookie::forget($cookie));
        }
        
        // Redirect to CAS logout
        $casLogoutUrl = config('cas.cas_logout_url');
        return redirect()->away($casLogoutUrl);
    }
}