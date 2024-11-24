<?php

declare(strict_types=1);

namespace Manychois\Views;

/**
 * Holds the data to be used in the view.
 */
class ViewDataMap
{
    /**
     * @var array<string,mixed>
     */
    private array $internal;

    /**
     * Creates a new instance of ViewDataMap.
     *
     * @param array<string,mixed> $data The data to be used in the view.
     */
    public function __construct(array $data)
    {
        if (\array_is_list($data) && \count($data) > 0) {
            throw new \TypeError('Data must be an associative array.');
        }

        $this->internal = $data;
    }

    /**
     * Clears all data.
     */
    public function clear(): void
    {
        $this->internal = [];
    }

    /**
     * Deletes the specified key, if it exists.
     *
     * @param string $key The key to delete.
     */
    public function delete(string $key): void
    {
        unset($this->internal[$key]);
    }

    /**
     * Returns the value of the specified key.
     *
     * @param string     $key     The key of the value to return.
     * @param mixed|null $default The default value to return if the key does not exist.
     *
     * @return mixed The value of the specified key.
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return $this->internal[$key] ?? $default;
    }

    /**
     * Returns the value of the specified key as a boolean.
     *
     * @param string $key     The key of the value to return.
     * @param bool   $default The default value to return if the key does not exist.
     *
     * @return bool The value of the specified key as a boolean.
     */
    public function getBool(string $key, bool $default = false): bool
    {
        $value = $this->internal[$key] ?? null;
        if (\is_bool($value)) {
            return $value;
        }
        if ($value === null) {
            return $default;
        }
        if (\is_scalar($value)) {
            return \filter_var($value, \FILTER_VALIDATE_BOOLEAN);
        }

        return $default;
    }

    /**
     * Returns the value of the specified key as a float.
     *
     * @param string $key     The key of the value to return.
     * @param float  $default The default value to return if the key does not exist.
     *
     * @return float The value of the specified key as a float.
     */
    public function getFloat(string $key, float $default = 0.0): float
    {
        $value = $this->internal[$key] ?? $default;
        if (\is_float($value)) {
            return $value;
        }

        if (\is_scalar($value)) {
            $value = \floatval($value);
        }

        return $default;
    }

    /**
     * Returns the value of the specified key as an integer.
     *
     * @param string $key     The key of the value to return.
     * @param int    $default The default value to return if the key does not exist.
     *
     * @return int The value of the specified key as an integer.
     */
    public function getInt(string $key, int $default = 0): int
    {
        $value = $this->internal[$key] ?? $default;
        if (\is_int($value)) {
            return $value;
        }

        if (\is_scalar($value)) {
            $value = \intval($value);
        }

        return $default;
    }

    /**
     * Returns the value of the specified key as a list of objects.
     *
     * @template T of object
     *
     * @param string          $key   The key of the value to return.
     * @param class-string<T> $class The class of the objects in the list.
     *
     * @return \Generator<int,T> The value of the specified key as a list of objects.
     */
    public function getListOfObjects(string $key, string $class): \Generator
    {
        $value = $this->internal[$key] ?? null;
        if (!\is_iterable($value)) {
            return;
        }

        foreach ($value as $item) {
            if (!($item instanceof $class)) {
                throw new \TypeError(\sprintf('Invalid type in object list. Found %s.', \get_debug_type($item)));
            }

            yield $item;
        }
    }

    /**
     * Returns the value of the specified key as the specified object.
     *
     * @template T of object
     *
     * @param string          $key   The key of the value to return.
     * @param class-string<T> $class The class of the object.
     *
     * @return T The value of the specified key as the specified object.
     */
    public function getObject(string $key, string $class): mixed
    {
        $value = $this->internal[$key] ?? null;
        if ($value instanceof $class) {
            return $value;
        }

        throw new \TypeError(\sprintf('Invalid type. Expected %s, found %s.', $class, \get_debug_type($value)));
    }

    /**
     * Returns the value of the specified key as a string.
     *
     * @param string $key     The key of the value to return.
     * @param string $default The default value to return if the key does not exist.
     *
     * @return string The value of the specified key as a string.
     */
    public function getString(string $key, string $default = ''): string
    {
        $value = $this->internal[$key] ?? $default;
        if (\is_string($value)) {
            return $value;
        }
        if ($value instanceof \Stringable) {
            return (string) $value;
        }

        if (\is_scalar($value)) {
            return \strval($value);
        }

        return $default;
    }

    /**
     * Returns whether the specified key exists.
     *
     * @param string $key The key to check.
     *
     * @return bool Whether the specified key exists.
     */
    public function has(string $key): bool
    {
        return \array_key_exists($key, $this->internal);
    }

    /**
     * Sets the value of the specified key.
     *
     * @param string $key   The key of the value to set.
     * @param mixed  $value The value to set.
     */
    public function set(string $key, mixed $value): void
    {
        $this->internal[$key] = $value;
    }

    /**
     * Returns the value of the specified key as a ViewDataMap.
     * If the key does not exist, a new ViewDataMap is created and set as the value.
     * If the value is originally an associative array, it is converted to a ViewDataMap.
     *
     * @param string $key The key of the value to return.
     *
     * @return self The value of the specified key as a ViewDataMap.
     */
    public function to(string $key): self
    {
        $value = $this->internal[$key] ?? null;
        if ($value instanceof self) {
            return $value;
        }

        if ($value === null) {
            $map = new self([]);
        } elseif (\is_array($value)) {
            // @phpstan-ignore argument.type
            $map = new self($value);
        } else {
            throw new \TypeError(
                \sprintf('Invalid type. Expected %s, Found %s.', self::class, \get_debug_type($value))
            );
        }

        $this->set($key, $map);

        return $map;
    }
}
