# Laravel CAS Authentication

A Laravel package for Central Authentication Service (CAS) integration with additional authorization capabilities.

## Installation

You can install the package via composer:

```bash
composer require yassine-as/laravel-cas-auth
```

## Publish Configuration

After installing the package, publish the configuration file:

```bash
php artisan vendor:publish --provider="YassineAs\CasAuth\Providers\CasAuthServiceProvider" --tag="cas-config"
```

## Configuration

Update your `.env` file with the necessary CAS configuration:

```
CAS_HOST=your-cas-server.example.com
CAS_DEBUG=false
CAS_VERBOSE_ERRORS=false
CAS_API_ENDPOINT=https://your-api-endpoint.com
CAS_API_KEY=your-api-key
```

## Usage

### Middleware

Add the middleware to your routes or controllers:

```php
// In routes/web.php
Route::middleware(['cas.auth'])->group(function () {
    // Protected routes that require CAS authentication
    Route::get('/dashboard', 'DashboardController::class ,"index"');
});
```

### Facade Usage

You can use the CasAuth facade in your controllers:

```php
use YassineAs\CasAuth\Facades\CasAuth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = CasAuth::getUser();
        $attributes = CasAuth::getAttributes();
        
        return view('profile', compact('user', 'attributes'));
    }
    
    public function logout()
    {
        CasAuth::logout();
        return redirect()->route('home');
    }
}
```

### Accessing User Details

In your controller methods, you can access the user details that were set by the middleware:

```php
public function dashboard(Request $request)
{
    $userDetails = $request->attributes->get('userDetails');
    
    return view('dashboard', compact('userDetails'));
}
```

## Testing

```bash
composer test
```

## Security

If you discover any security issues, please email your.email@example.com instead of using the issue tracker.

## Credits

- [Yassine ait sidi brahim](https://github.com/Asyassin10)

