API Documentation
======

### registerClass()

Use the `registerClass($class, $index)` method to register a class on one or multiple indexes:

	```php
	$factory = (new MyClass)
		->registerClass('RuntimeException', 'Runtime')
		->registerClass(new \PDOException, ['PDO', 'SQL']);
	```

(i) Indexes are case insensitive.
(i) You register a class by its name (string) or by an instance (object).


### retrieveClass()

Use the `(string) retrieveClass($index)` method to get a class (string) according to an index:

	```php
	(new MyClass)->retrieveClass('sql');
	// Return the string "PDOException"
	```


### newInstance()

Use the `(object) newInstance($index, $arguments = [])` method to instance a class according to an index:

	```php
	(new MyClass)->newInstance('sql');
	// Return an instance of `PDOException`
	```
	
The second argument allow you to pass the constructor parameters:

	```php
	(new MyClass)->newInstance('sql', ['Error when retrieving the database', 500]);
	// Return an instance of `PDOException` with a message and a code
	```

