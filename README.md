## About this project

An application built for Elovate to translate product information using forms and the DeepL API. This application is built with Laravel 12 and Livewire 3.

No authentication is required for this assignment, therefore I have not added it.

To not have the home page be a 404, I have simply added a link there to the orders index page.

**URIs:**
- `/` - Homepage with button to products overview
- `/products` - Products overview (50 per page)
- `/products/create` - A form to create an order
- `/products/show` - Single product page with details
- `/products/edit` - Edit form for specific order
- `/products/add-translation` - A form to add a translation to a product

## Requirements
- PHP 8.2+
- [Laravel 11](https://laravel.com/)
- [Laravel Herd (or Valet)](https://herd.laravel.com/) or [Docker/Laravel Sail](https://laravel.com/docs/11.x/sail)
- [Composer](https://getcomposer.org/)
- [(Optional) Postman or any API testing tool](https://www.postman.com/downloads/)

## After cloning this project
I have used Laravel Herd for this project. If you prefer you use Laravel Sail, see below:<br><br>
**If you use Docker, here's how to install Composer dependencies if you don't have Composer installed:**<br>
<pre><code>docker run --rm \
-u "$(id -u):$(id -g)" \
-v "$(pwd):/var/www/html" \
-w /var/www/html \
laravelsail/php82-composer:latest \
composer install --ignore-platform-reqs</code></pre>

Optional: Replace php82 with the PHP version you're using.<br>
For example: If you're using PHP 8.3 then replace 82 with 83.

**After installing Laravel Sail:**<br>
`./vendor/bin/sail up -d`

**Optional:**<br>
Add an alias for `./vendor/bin/sail` at the bottom either your `.bashrc` or `.zshrc`:<br>
`alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'`
So whenever you need to use `./vendor/bin/sail`, you can just use `sail` or whatever your alias is.

**PHP Artisan**<br>
Artisan commands are needed to install dependencies and run necessary commands like migrations.<br>
- For Laravel Herd/Valet or any other PHP install: `php artisan`
- For Sail, it's `./vendor/bin/sail artisan`

## Installation
**Dependencies**<br>
If you haven't installed Composer dependencies yet, run `composer install`, unless you use the Laravel Sail option above

**Environment**<br>
`cp .env.example .env`

**Run migrations:**<br>
`php artisan migrate` or `./vendor/bin/sail artisan migrate`

**Seeding (optional)**
`php artisan db:seed` or `./vendor/bin/sail artisan db:seed`

**Generate application key:**<br>
`php artisan key:generate` or `./vendor/bin/sail artisan key:generate`

**NPM:**<br>
- `npm install`
- `npm run build`

**Run tests:**<br>
`php artisan test` or `./vendor/bin/sail artisan test`

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
