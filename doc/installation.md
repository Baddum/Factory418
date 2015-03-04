Installation
======

Via composer
------

Factory418 is available on (Packagist [baddum/factory418](http://packagist.org/packages/baddum/factory418))
and as such installable via [Composer](http://getcomposer.org/).

Run the following command in your console:

	```sh
	composer require baddum/factory418
	```
	
	
Usage 
------
	
You can transform any of your class into a factory by using the `FactoryTrait`:

	```php
	use Baddum\Factory418\FactoryTrait;
	class MyClass
	{
		use FactoryTrait;
	}
	```

