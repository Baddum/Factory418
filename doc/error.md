Error handling
======

_onFactoryIndexOverride()
------

When we try to register a class over another one, a `RuntimeException` is thrown.
You can override the `_onFactoryIndexOverride()` method to change this behaviour:

	```php
	use Baddum\Factory418\FactoryTrait;
	class MyClass
	{
		use FactoryTrait;
		
		protected function _onFactoryIndexOverride($index, $value, $override)
		{
			// Do nothing (and register the class normally)
		}
	}
	```


_onFactoryIndexNotFound()
------

When we try to retrieve a class and no one is registered, a `RuntimeException` is thrown.
You can override the `_onFactoryIndexNotFound()` method to change this behaviour:

	```php
	use Baddum\Factory418\FactoryTrait;
	class MyClass
	{
		use FactoryTrait;
		
		protected function _onFactoryIndexNotFound($index)
		{
			// Return a default class	or instance
			return $this;
		}
	}
	```
