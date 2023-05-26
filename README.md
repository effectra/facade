# Facade Class

The `Facade` class is a utility class that provides a simplified interface to access classes or services in your PHP applications.

## Installation

The `Facade` class is a standalone class and doesn't require any installation. You can simply include the class file in your project.

```php
require_once 'path/to/Facade.php';
```

## Usage

To use the `Facade` class, follow these steps:

1. Extend the `Facade` class with your custom facade class.
2. Implement the `getFacadeAccessor()` method in your custom facade class.
3. Optionally, set the resolved instance or container using the `setResolvedInstance()` or `setContainer()` method respectively.
4. Access the methods of the underlying class or service using the static methods of your custom facade class.

Here's an example:

```php
use Effectra\Facade;

class MyFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return MyService::class;
    }
}

// Usage
MyFacade::setResolvedInstance(new MyService());
MyFacade::someMethod();
```

In this example, we've created a custom facade class `MyFacade` by extending the `Facade` class. The `getFacadeAccessor()` method in `MyFacade` returns the class name of `MyService` that we want to access using the facade.

By setting the resolved instance using `setResolvedInstance()`, we directly provide an instance of `MyService` to the facade. This allows us to access the methods of `MyService` using the static methods of `MyFacade`.

You can also use a container instead of setting the resolved instance directly. To do so, create a container, bind the class name to a key in the container, and set the container using `setContainer()`.

```php
use Effectra\Facade;
use Effectra\Container\Container;

class MyFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'myService';
    }
}

// Usage
$container = new Container();
$container->bind('myService', MyService::class);

MyFacade::setContainer($container);
MyFacade::someMethod();
```

In this example, we've used a simple `Container` class to bind the class name of `MyService` to the key `'myService'`. By setting the container using `setContainer()`, the `Facade` class resolves the instance from the container when the static method is called.

Make sure to replace `'MyService'` and `'someMethod()'` with the actual class and method names you're using in your application.

## Contributing

Contributions are welcome! If you find any issues or would like to add new features or improvements, please open an issue or submit a pull request.

Before contributing, please make sure to review the [contribution guidelines](CONTRIBUTING.md).

## License

This class is open-source and available under the [MIT License](LICENSE).
