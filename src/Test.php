<?php
/**
 * Created by PhpStorm.
 * User: Tomasz Ignaszak
 * Date: 01.09.16
 * Time: 17:18
 */

declare(strict_types=1);

namespace Ignaszak\TestingTools;

/**
 * Class Test
 * @package Ignaszak\TestTools
 */
class Test
{

    /**
     * @var null
     */
    public static $object = null;

    /**
     * @param string $property
     * @param null $object
     * @return mixed
     */
    public static function get(string $property, $object = null)
    {
        return \PHPUnit_Framework_Assert::readAttribute(
            is_null($object) ? self::$object : $object,
            $property
        );
    }

    /**
     * @param string $method
     * @param array $args
     * @param null $object
     * @return mixed
     */
    public static function call(
        string $method,
        array $args = [],
        $object = null
    ) {
        $object = is_null($object) ? self::$object : $object;
        $class = new \ReflectionClass(
            is_object($object) ? get_class($object) : $object
        );
        $method = $class->getMethod($method);
        $method->setAccessible(true);
        $object = is_object($object) ? $object : $class;
        return $method->invokeArgs($object, $args);
    }

    /**
     * @param string $property
     * @param null $value
     * @param null $object
     */
    public static function inject(
        string $property,
        $value = null,
        $object = null
    ) {
        $object = is_null($object) ? self::$object : $object;
        $class = $object;
        if (is_object($object)) {
            $class = get_class($object);
        }
        $reflection = new \ReflectionProperty($class, $property);
        $reflection->setAccessible(true);
        $reflection->setValue($object, $value);
    }
}
