Error handling
======

onClassIndexOverride()
------

When we try to register a class over another one, a `RuntimeException` is thrown.
You can override the `onClassIndexOverride($index, $className)` method to change this behaviour:

	```php
	use Baddum\Factory418\FactoryTrait;
	class MyClass
	{
		use FactoryTrait;
		
		protected function onClassIndexOverride($index, $className)
		{
			// Do nothing (and register the class normally)
		}
	}
	```


onNoClassIndexFound()
------

When we try to retrieve a class and no one is registered, a `RuntimeException` is thrown.
You can override the `onNoClassIndexFound($index)` method to change this behaviour:

	```php
	use Baddum\Factory418\FactoryTrait;
	class MyClass
	{
		use FactoryTrait;
		
		protected function onNoClassIndexFound($index)
		{
			// Return a default class	
			return 'Exception';
		}
	}
	```
