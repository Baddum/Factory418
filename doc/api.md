API Documentation
======

registerClass()
------

	```php
	self registerClass(string|object $class, string|array $index, bool $override = false)
	```

Use the `registerClass()` method to register a class on one or several indexes.

	```php
	$factory = (new FileReader)
		->registerClass('IniFileReader', 'ini')
		->registerClass('YamlFileReader, ['yml', 'yaml']);
	```

(i) Indexes are case insensitive.

You can register a class by its name (string) or by an instance (object).
The factory will produce a new instance of this class at every call.

By default, you can not register an index if it is already reserved.
You can ask authorization to override by passing a third parameter to `true`:

	```php
	(new FileReader)->registerClass('MockIniFileReader', 'ini', true);
	```


registerInstance()
------

	```php
	self registerInstance(object $instance, string|array $index, bool $override = false)
	```

Use the `registerInstance()` method to register an object instance on one or several indexes.

	```php
	$factory = (new MyApplication)
		->registerInstance($monolog, 'logger');
	```

(i) Indexes are case insensitive.

By default, you can not register an index if it is already reserved.
You can ask authorization to override by passing a third parameter to `true`:

	```php
	(new MyApplication)->registerInstance($mockMonolog, 'logger', true);
	```


getInstance()
------

	```php
	object getInstance(string $index)
	```

Use the `getInstance()` method to get an instance according to an index:

	```php
	(new FileReader)->getInstance('ini');
	// Return an instance of `IniFileReader`
	```
	
