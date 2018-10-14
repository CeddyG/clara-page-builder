Clara Page Builder
===============

Page builer using bootstrap for Clara.

## Installation

```php
composer require ceddyg/clara-page-builder
```

Add to your providers in 'config/app.php'
```php
CeddyG\ClaraPageBuilder\PageBuilderServiceProvider::class,
```

Then to publish the files.
```php
php artisan vendor:publish --provider="CeddyG\ClaraPageBuilder\PageBuilderServiceProvider"
```
