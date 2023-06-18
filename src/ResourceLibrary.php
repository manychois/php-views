<?php

declare(strict_types=1);

namespace Manychois\Views;

use Closure;
use Exception;
use InvalidArgumentException;
use OutOfBoundsException;
use OutOfRangeException;

/**
 * Supports dependency management of related resources.
 *
 * @template T
 */
class ResourceLibrary
{
    /**
     * @var Array<string, T>
     */
    private array $resources = [];

    /**
     * @var Array<string, Array<string>>
     */
    private array $dependencies = [];

    /**
     * @var Array<string>
     */
    private array $released = [];

    /**
     * Find the first resource that matches the predicate.
     *
     * @param Closure $predicate Function that takes a resource key and value and returns true if it matches.
     *
     * @return string|null The resource key or null if not found.
     */
    public function peek(Closure $predicate): ?string
    {
        foreach ($this->resources as $key => $value) {
            if ($predicate($key, $value)) {
                return $key;
            }
        }
        return null;
    }

    /**
     * Returns a list of resource values based on the given key and its dependencies.
     *
     * @param string $key The resource key.
     *
     * @return array<string, T> The list of resource values.
     */
    public function pull(string $key): array
    {
        if (array_key_exists($key, $this->resources)) {
            $chain = $this->resolve($key);
            $result = [];
            foreach ($chain as $c) {
                $result[$c] = $this->resources[$c];
                unset($this->resources[$c]);
                unset($this->dependencies[$c]);
                $this->released[] = $c;
            }
            return $result;
        }
        if (in_array($key, $this->released, true)) {
            return [];
        }
        throw new OutOfBoundsException("Undefined resource found: $key");
    }

    /**
     * Push a resource into the library.
     *
     * @param string        $key          The resource key.
     * @param mixed         $value        The resource value.
     * @param array<string> $dependencies The list of resource keys that this resource depends on.
     *
     * @return bool True if the resource is successfully pushed, false if the resource already exists, or if it has been
     * released.
     */
    public function push(string $key, mixed $value, array $dependencies = []): bool
    {
        if (array_key_exists($key, $this->resources) || in_array($key, $this->released, true)) {
            return false;
        }
        if (in_array($key, $dependencies, true)) {
            throw new InvalidArgumentException("Resource $key cannot depend on itself.");
        }
        $this->resources[$key] = $value;
        $this->dependencies[$key] = array_unique($dependencies);
        return true;
    }

    /**
     * Remove a resource from the library.
     *
     * @param string $key The resource key.
     *
     * @return bool True if the resource is successfully removed, false if the resource does not exist, or if it has
     * been released.
     */
    public function remove(string $key): bool
    {
        if (array_key_exists($key, $this->resources)) {
            unset($this->resources[$key]);
            unset($this->dependencies[$key]);
            return true;
        }
        return false;
    }

    /**
     * Returns a list of resource keys based on the given key and its immediate dependencies.
     * Only resources that have not been released will be returned.
     *
     * @param string $key The resource key.
     *
     * @return array<string> The list of resource keys.
     */
    private function getUnreleasedDependencies(string $key): array
    {
        $deps = array_diff($this->dependencies[$key], $this->released);
        $missing = array_diff($deps, array_keys($this->resources));
        if ($missing) {
            throw new OutOfRangeException(
                sprintf('Undefined resource dependencies found: %s', implode(', ', $missing)),
            );
        }
        return $deps;
    }

    /**
     * Returns a list of resource keys based on the given key and its all dependencies.
     * Only resources that have not been released will be returned.
     *
     * @param string        $key      The resource key.
     * @param array<string> $depCheck The list of resource keys that are being checked for circular dependencies.
     *
     * @return array<string> The list of resource keys.
     */
    private function resolve(string $key, array $depCheck = []): array
    {
        $deps = $this->getUnreleasedDependencies($key);
        if (empty($deps)) {
            return [$key];
        }

        $resolvedDeps = [];
        foreach ($deps as $dep) {
            if (in_array($dep, $depCheck, true)) {
                $depChain = array_merge([$dep, $key], $depCheck);
                throw new Exception(sprintf('Circular dependency detected: %s', implode(' < ', $depChain)));
            }
            $temp = $this->resolve($dep, array_merge([$key], $depCheck));
            $resolvedDeps = array_merge($resolvedDeps, $temp);
        }
        return array_unique(array_merge($resolvedDeps, [$key]));
    }
}
