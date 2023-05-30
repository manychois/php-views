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
     * @param Closure $predicate Function that takes a resource key and value and returns true if it matches.
     * @return null|string The resource key or null if not found.
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
     * @param string $key The resource key.
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
        if (in_array($key, $this->released)) {
            return [];
        }
        throw new OutOfBoundsException("Undefined resource found: $key");
    }

    /**
     * Push a resource into the library.
     * @param string $key The resource key.
     * @param mixed $value The resource value.
     * @param array<string> $dependencies The list of resource keys that this resource depends on.
     * @return bool True if the resource is successfully pushed, false if the resource already exists, or if it has been
     * released.
     */
    public function push(string $key, mixed $value, array $dependencies = []): bool
    {
        if (array_key_exists($key, $this->resources) || in_array($key, $this->released)) {
            return false;
        }
        if (in_array($key, $dependencies)) {
            throw new InvalidArgumentException("Resource $key cannot depend on itself.");
        }
        $this->resources[$key] = $value;
        $this->dependencies[$key] = array_unique($dependencies);
        return true;
    }

    /**
     * Remove a resource from the library.
     * @param string $key The resource key.
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
     * @param string $key The resource key.
     * @return array<string> The list of resource keys.
     */
    private function getUnreleasedDependencies(string $key): array
    {
        $deps = array_diff($this->dependencies[$key], $this->released);
        $missing = array_diff($deps, array_keys($this->resources));
        if ($missing) {
            throw new OutOfRangeException('Undefined resource dependencies found: ' . implode(', ', $missing));
        }
        return $deps;
    }

    /**
     * Returns a list of resource keys based on the given key and its all dependencies.
     * Only resources that have not been released will be returned.
     * @param string $key The resource key.
     * @return array<string> The list of resource keys.
     */
    private function resolve(string $key): array
    {
        $deps = $this->getUnreleasedDependencies($key);
        if (empty($deps)) {
            return [$key];
        }

        $toVisit = $deps;
        $visited = [$key];
        $chains = [array_merge($toVisit, [$key])];
        while ($toVisit) {
            $candidate = array_shift($toVisit);
            $visited[] = $candidate;
            $deps = $this->getUnreleasedDependencies($candidate);
            if ($deps) {
                foreach ($chains as &$chain) {
                    $i = array_search($candidate, $chain, true);
                    if ($i === false) {
                        continue;
                    }
                    foreach ($deps as $d) {
                        $j = array_search($d, $chain, true);
                        if ($j + 1 === count($chain)) {
                            throw new Exception(
                                'Circular dependency detected: ' . implode(' < ', array_merge([$d], $chain))
                            );
                        }
                        if ($j === false) {
                            array_splice($chain, $i, 0, [$d]);
                        } elseif ($j > $i) {
                            array_splice($chain, $j, 1);
                            array_splice($chain, $i, 0, [$d]);
                        }
                    }
                }
                $chains[] = array_merge($deps, [$candidate]);
                $toVisit = array_merge($toVisit, array_diff($deps, $visited, $toVisit));
            } else {
                $chains[] = [$candidate];
            }
        }
        return $chains[0];
    }
}
