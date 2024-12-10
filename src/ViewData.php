<?php

declare(strict_types=1);

namespace Manychois\Views;

/**
 * Holds the data to be used in the view.
 */
class ViewData
{
    /**
     * @var array<string,mixed>
     */
    private array $internal;

    /**
     * Creates a new instance of ViewData.
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
     * Returns the value of the specified key as an array.
     *
     * @template T
     *
     * @param string   $key     The key of the value to return.
     * @param array<T> $default The default value to return if the key does not exist, or the value is not an iterable.
     *
     * @return array<T> The value of the specified key as an array.
     */
    public function getArray(string $key, array $default = []): array
    {
        $value = $this->internal[$key] ?? $default;
        if (\is_array($value)) {
            return $value;
        }
        if (\is_iterable($value)) {
            return \iterator_to_array($value);
        }

        return $default;
    }

    /**
     * Returns the value of the specified key as a boolean.
     * If the value is not a boolean, it will be converted into boolean by using
     * `filter_var()` with the `FILTER_VALIDATE_BOOLEAN` filter.
     *
     * @param string $key     The key of the value to return.
     * @param bool   $default The default value to return if:
     *                        1. The value is null, or
     *                        2. The key does not exist, or
     *                        3. The conversion fails.
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

        return \filter_var($value, \FILTER_VALIDATE_BOOLEAN, \FILTER_NULL_ON_FAILURE) ?? $default;
    }

    /**
     * Returns the value of the specified key as a float.
     *
     * @param string $key     The key of the value to return.
     * @param float  $default The default value to return if:
     *                        1. The value is null, or
     *                        2. The key does not exist, or
     *                        3. The conversion fails.
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
            return \floatval($value);
        }

        return $default;
    }

    /**
     * Returns the value of the specified key as an integer.
     *
     * @param string $key     The key of the value to return.
     * @param int    $default The default value to return if:
     *                        1. The value is null, or
     *                        2. The key does not exist, or
     *                        3. The conversion fails.
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
            return \intval($value);
        }

        return $default;
    }

    /**
     * Returns the value of the specified key as the specified object.
     * If the value is not an instance of the specified class, a `TypeError` is thrown.
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
     * @param string $default The default value to return if:
     *                        1. The value is null, or
     *                        2. The key does not exist.
     *                        3. The conversion fails.
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
            return $value->__toString();
        }

        if (\is_scalar($value)) {
            return \strval($value);
        }

        return $default;
    }

    /**
     * Returns whether the specified key exists.
     *
     * @param string $key             The key to check.
     * @param bool   $nullAsNonExists Whether to treat null values as non-existence.
     *
     * @return bool Whether the specified key exists.
     */
    public function has(string $key, bool $nullAsNonExists = true): bool
    {
        if (\array_key_exists($key, $this->internal)) {
            return $nullAsNonExists ? $this->internal[$key] !== null : true;
        }

        return false;
    }

    /**
     * Returns the value of the specified key as a ViewData.
     * If the key does not exist, a new ViewData is created and set as the value.
     * If the value is originally an associative array, it is converted to a ViewData.
     *
     * @param string $key The key of the value to return.
     *
     * @return self The value of the specified key as a ViewData.
     */
    public function into(string $key): self
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
                \sprintf('Invalid type. Expected array, found %s.', \get_debug_type($value))
            );
        }

        $this->set($key, $map);

        return $map;
    }

    /**
     * Iterates through the value of the specified key as a list of objects.
     * If the key does not exist, or the value is not an iterable, an empty generator is returned.
     * If the list item is not an instance of the specified class, a `TypeError` is thrown.
     *
     * @template T of object
     *
     * @param string          $key   The key of the value to return.
     * @param class-string<T> $class The class of the objects in the list.
     *
     * @return \Generator<int,T> The value of the specified key as a list of objects.
     */
    public function loopObjects(string $key, string $class): \Generator
    {
        $value = $this->internal[$key] ?? null;
        if (!\is_iterable($value)) {
            return;
        }

        foreach ($value as $item) {
            if (!($item instanceof $class)) {
                throw new \TypeError(\sprintf(
                    'Invalid type in object list. Expected %s, found %s.',
                    $class,
                    \get_debug_type($item)
                ));
            }

            yield $item;
        }
    }

    /**
     * Executes the specified action with extra data added to the view data.
     * The extra data is removed after the action is executed.
     *
     * @param array<string,mixed> $data   Extra data to add to the view data.
     * @param \Closure            $action The action to execute.
     *
     * @return mixed The result of the action.
     *
     * @phpstan-template TResult
     *
     * @phpstan-param \Closure(self):TResult $action
     *
     * @phpstan-return TResult
     */
    public function scope(array $data, \Closure $action): mixed
    {
        $toRestore = [];
        foreach ($data as $key => $value) {
            if (\array_key_exists($key, $this->internal)) {
                $toRestore[$key] = $this->internal[$key];
            }
            $this->internal[$key] = $value;
        }

        try {
            return $action($this);
        } finally {
            foreach (\array_keys($data) as $key) {
                unset($this->internal[$key]);
            }
            foreach ($toRestore as $key => $value) {
                $this->internal[$key] = $value;
            }
        }
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
}
