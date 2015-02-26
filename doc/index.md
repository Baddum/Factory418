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