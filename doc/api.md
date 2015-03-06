API Documentation
======

registerClass()
------

	```php
	(self) function registerClass($class, $index, $override)
	```

Use the `registerClass()` method to register a class on one or multiple indexes:

	```php
	$factory = (new MyClass)
		->registerClass('RuntimeException', 'Runtime')
		->registerClass(new \PDOException, ['PDO', 'SQL']);
	```

(i) Indexes are case insensitive.
(i) You register a class by its name (string) or by an instance (object).

By default, you can not register an index if it is already reserved.
You can ask authorization to override by passing a third parameter to `true`:

	```php
	(new MyClass)->registerClass('PDOException', 'SQL', true);
	```


retrieveClass()
------

	```php
	(string) function retrieveClass($index)
	```

Use the `retrieveClass()` method to get a class (string) according to an index:

	```php
	(new MyClass)->retrieveClass('sql');
	// Return the string "PDOException"
	```


newInstance()
------

	```php
	(object) function newInstance($index, $arguments = [])
	```

Use the `newInstance()` method to instance a class according to an index:

	```php
	(new MyClass)->newInstance('sql');
	// Return an instance of `PDOException`
	```
	
The second argument allow you to pass the constructor parameters:

	```php
	(new MyClass)->newInstance('sql', ['Error when retrieving the database', 500]);
	// Return an instance of `PDOException` with a message and a code
	```

