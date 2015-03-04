A factory provides an abstraction of a class constructor, so your code is not tied to specific class.
It could ease change and refactoring.

You can transform any of your class into a factory by using the `FactoryTrait`:

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
	(new MyClass)->newInstance('sql');
	// Return an instance of `PDOException`
	```