#Yii2 blog module

This module under heavy development. Don't use it in production.

Interface using [Startbootstrap Blog](http://startbootstrap.com/template-categories/blogs/) templates.


##Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist asdf-studio/yii2-blog-module "*"
```

or add

```
"asdf-studio/yii2-blog-module": "*"
```

to the require section of your `composer.json` file.


##Usage

Create `blog` module in your `modules` dir and file `modules/blog/Module.php` with this code:

```php
namespace frontend\modules\blog;

class Module extends \asdfstudio\blog\Module
{

}
```

Then add module too your config file:

```php
return [
    'bootstrap' => ['blog'],
    'modules' => [
    	...
        'blog' => [
            'class' => 'frontend\modules\blog\Module',
            'urlPrefix' => '/blog', // default is '/blog'
        ],
        ...
    ],
    ...
];
```

Then you need to apply migrations:

```
yii migrate/up --migrationPath=@vendor/asdf-studio/yii2-blog-module/migrations
```

All done. You can visit blog at `/blog`.

##Admin

Blog module is already integrated with [asdf-studio/yii2-admin-module](https://github.com/asdf-studio/yii2-admin-module).
