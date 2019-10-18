# SilenceOnTheWire Lumen Chat implementation

This is a simple interpretation of the chat application for everyone based on the GPL 3.0 license. Code under the GNU GPL license cannot be used in programs based on other licenses.

## Official Documentation

If you can setup database, cp .en.example to .env.

The first is database instalation. You must use command:

```bash
php artisan migrate --seed
```

Documentation for the chat microservice can be found on the [https://sleepy-citadel-03985.herokuapp.com/docs/index.html](https://sleepy-citadel-03985.herokuapp.com/docs/index.html).

### Apache setup

Use .htaccess:
```bash
Options +FollowSymLinks
RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]
```

Virtual host setup:

```bash
<VirtualHost *:80>
    ServerAdmin webmaster@myapp.com
    ServerName myapp.com
    DocumentRoot /var/www/myapp.com/public/

    <Directory /var/www/myapp.com/public/>
        Options -Indexes +FollowSymLinks +MultiViews
        AllowOverride All
        Require all granted
        <FilesMatch \.php$>
            # Change this "proxy:unix:/path/to/fpm.socket"
            # if using a Unix socket
            #SetHandler "proxy:fcgi://127.0.0.1:9000"
        </FilesMatch>
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/myapp.com-error.log

    # Possible values include: debug, info, notice, warn, error, crit,
    # alert, emerg.
    LogLevel warn
    CustomLog ${APACHE_LOG_DIR}/myapp.com-access.log combined
</VirtualHost>
```

# Nginx setup

Use setup:

```bash
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

## Security Vulnerabilities

If you discover a security vulnerability within this solution, please send an e-mail to Adrian Stolarski at adrian.stolarski@gmail.com. All security vulnerabilities will be promptly addressed.

## License

This soulution is a [GPL License](https://en.wikipedia.org/wiki/GNU_General_Public_License).

## Shopware Solution

The shopware middleware is here:

```php
<?php


namespace App\Http\Middleware;


use App\AuthProviders\ShopwareProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShopwareAuth
{

    public function handle(Request $request, Closure $next) {
        $header = $request->headers->get('X-AUTH');
        $user_data = json_decode(base64_decode($header), true);
        $authService = new ShopwareProvider($user_data['url'], $user_data['username'], $user_data['api_key']);
        $result = $authService->get($user_data['user_id']);
        if($result->status() !== Response::HTTP_OK){
            return response()->json(['content' => [], 'error_messages' => []], Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
```

If you can usage shopware api to authorization, you must enable this middleware in bootstrap/app.php:

```php
$app->routeMiddleware([
     'auth' => App\Http\Middleware\ShopwareAuth::class,
]);
```

And add it to routing in routes/web.php:

```php
$router->post('/channels', ['uses' => 'CreateChannelController@create', 'middleware' => ['auth']]);
```

## Middleware

The current solution uses middlewares:

```php
$app->middleware([
     App\Http\Middleware\DBTransaction::class,
    App\Http\Middleware\LumenCors::class,
]);
```

## Commercial usage

If you want to use this software under a commercial license without publishing derivative sources, all you have to do is deposit $ 15 peer year to my paypal account: adrian.stolarski@gmail.com
