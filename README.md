# Template Class (PHP / HTML)

A simple class to create HTML via PHP and template via JSON file

# Install (via global Composer)
```
composer require blakepro/template --no-cache
```

# Install (via Composer.phar)
```
php composer.phar require blakepro/template
```

# Install Composer and Class (via Python)
```
curl -o installer.py https://raw.githubusercontent.com/BlakePro/Template/master/installer.py -H 'Cache-Control: no-cache' ; python installer.py;
```

# Update (via Composer)
```
php composer.phar update blakepro/template --no-cache
```
Not resolved packages use
```
php composer.phar update blakepro/template --ignore-platform-reqs
```

# Usage PHP file
```
<?php require __DIR__ . '/vendor/autoload.php';

//HTML
$html = new blakepro\Template\Html();

//DATABASE
$pdo = new blakepro\Template\Sql(['host' => '', 'name' => '', 'user' => '', 'password' => '']);

//UTILITIES
$util = new blakepro\Template\Utilities(['encryption_key' => '']);

```
#  Documentation / Wiki

[https://github.com/BlakePro/LibraryTemplatePHP/wiki](https://github.com/BlakePro/LibraryTemplatePHP/wiki)
