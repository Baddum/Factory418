Factory418
==============
[![Latest Stable Version](https://poser.pugx.org/baddum/factory418/v/stable.svg)](https://github.com/Baddum/Factory418)
[![Build Status](https://travis-ci.org/Baddum/Factory418.png?branch=master)](https://travis-ci.org/Baddum/Factory418)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Baddum/Factory418/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Baddum/Factory418/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Baddum/Factory418/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Baddum/Factory418/?branch=master)
[![Total Downloads](https://poser.pugx.org/baddum/factory418/downloads.svg)](https://packagist.org/packages/baddum/factory418)
[![License](https://poser.pugx.org/baddum/factory418/license.svg)](http://opensource.org/licenses/MIT)


`Factory418` provides a PHP trait to easily create factory.

1. [Features](#features)
2. [How to Install](#how-to-install)
3. [How to Contribute](#how-to-contribute)
4. [Author & Community](#author--community)



Features
--------------

Transform any of your class by using the `FactoryTrait`:

```php
use Baddum\Factory418\FactoryTrait;
class MyClass
{
    use FactoryTrait;
}
```

Use the `registerClass()` method to register a class on one or multiple indexes:

```php
$factory = (new MyClass)
	->registerClass('RuntimeException', 'Runtime')
	->registerClass('PDOException', ['PDO', 'SQL']);
```

Use the `newInstance()` method to instance a class according to an index:

```php
$instance = $factory->newInstance('sql');
```



How to Install
--------

This library package requires `PHP 5.4` or later.<br>
Install [Composer](http://getcomposer.org/doc/01-basic-usage.md#installation) and run the following command to get the latest version:

```sh
composer require baddum/factory418
```



How to Contribute
--------

1. [Star](https://github.com/Baddum/Factory418/stargazers) the project!
2. Tweet and blog about Factory418 and [Let me know](https://twitter.com/iamtzi) about it.
3. [Report a bug](https://github.com/Baddum/Factory418/issues/new) that you find
4. Pull requests are highly appreciated. Please review the [guidelines for contributing](https://github.com/Baddum/Factory418/blob/master/CONTRIBUTING.md) to go further.



Author & Community
--------

Factory418 is under [MIT License](http://opensource.org/licenses/MIT).<br>
It was created & is maintained by [Thomas ZILLIOX](http://tzi.fr).