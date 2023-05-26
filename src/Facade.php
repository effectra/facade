<?php

declare(strict_types=1);

namespace Effectra;

use RuntimeException;

/**
 * Class Facade
 *
 * The Facade class provides a simplified interface to access classes or services in PHP applications.
 */
class Facade
{
    /**
     * @var mixed The container instance.
     */
    protected static $container;

    /**
     * @var mixed The resolved instance.
     */
    protected static $resolvedInstance;

    /**
     * Set the container instance.
     *
     * @param mixed $container The container instance.
     * @return void
     */
    public static function setContainer($container): void
    {
        static::$container = $container;
    }

    /**
     * Get the accessor for the facade.
     *
     * @return mixed The accessor for the facade.
     *
     * @throws RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        throw new RuntimeException("Facade does not implement getFacadeAccessor method.");
    }

    /**
     * Handle dynamic, static calls to the object.
     *
     * @param string $method The method name.
     * @param array $args The method arguments.
     * @return mixed The result of the method call.
     *
     * @throws RuntimeException
     */
    public static function __callStatic($method, $args)
    {
        $instance = static::getInstance();

        if (!method_exists($instance, $method)) {
            throw new RuntimeException(sprintf('Method "%s" not found.', $method));
        }

        return $instance->$method(...$args);
    }

    /**
     * Get the resolved instance.
     *
     * @return mixed The resolved instance.
     */
    protected static function getInstance()
    {
        if (static::$resolvedInstance) {
            return static::$resolvedInstance;
        }

        if (static::$container && static::$container->has(static::getFacadeAccessor())) {
            static::$resolvedInstance = static::$container->get(static::getFacadeAccessor());
        } else {
            $class = static::getFacadeAccessor();
            static::$resolvedInstance = new $class;
        }

        return static::$resolvedInstance;
    }
}
