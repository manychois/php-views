<?php

declare(strict_types=1);

namespace Manychois\Views;

/**
 * Base class for building view template composited of DOM nodes.
 */
abstract class AbstractDomView
{
    private static int $idCounter = 0;
    /**
     * @var ViewDataMap The data shared between parent and child views.
     */
    protected readonly ViewDataMap $data;
    private ?self $parent = null;
    private ?self $child = null;

    /**
     * Creates a new instance of AbstractView.
     *
     * @param ViewDataMap $data The data shared between parent and child views.
     */
    public function __construct(ViewDataMap $data)
    {
        $this->data = $data;
    }

    /**
     * Returns the main content of the child view, if any.
     *
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $default The default content to return if the
     *                                                                              child view does not exist.
     *
     * @return \Generator<int,string|\DOMNode|null> The main content of the child view.
     */
    final public function content(string|\DOMNode|iterable|\Closure|null $default = null): \Generator
    {
        if ($this->child === null) {
            yield from $this->resolveDefault($default);
        } else {
            yield from $this->child->render();
        }
    }

    /**
     * Returns the content of the specified region provided by the child view, if any.
     *
     * @param string                                                       $name    The name of the region.
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $default The default content to return if the
     *                                                                              region does not exist,
     *                                                                              or if the child view does not exist.
     *
     * @return \Generator<int,string|\DOMNode|null> The content of the specified region.
     */
    final public function region(string $name, string|\DOMNode|iterable|\Closure|null $default = []): \Generator
    {
        if ($this->child === null) {
            yield from $this->resolveDefault($default);
        } else {
            $reflection = new \ReflectionObject($this->child);
            $methodName = 'renderRegion' . \ucfirst($name);
            if ($reflection->hasMethod($methodName)) {
                /** @var \Generator<int,string|\DOMNode|null> $generator */
                $generator = $this->child->$methodName();

                yield from $generator;
            } else {
                yield from $this->resolveDefault($default);
            }
        }
    }

    /**
     * Returns the combined content of this view and its parent views.
     *
     * @return \Generator<int,string|\DOMNode|null> The combined content of this view and its parent views.
     */
    final public function fullRender(): \Generator
    {
        if ($this->parent === null) {
            yield from $this->render();
        } else {
            yield from $this->parent->fullRender();
        }
    }

    /**
     * Returns a new unique id value.
     * Uniqueness is based on an internal static counter.
     *
     * @param string $prefix The prefix of the id.
     *
     * @return string A new unique id.
     */
    final protected function newId(string $prefix = 'id-'): string
    {
        self::$idCounter++;

        return $prefix . self::$idCounter;
    }

    /**
     * Sets the parent view of this view.
     *
     * @param self $parent The parent view.
     */
    final protected function inherit(self $parent): void
    {
        $this->parent = $parent;
        $parent->child = $this;
    }

    /**
     * Returns the main content of this view.
     *
     * @return \Generator<int,string|\DOMNode|null> The main content of this view.
     */
    abstract protected function render(): \Generator;

    /**
     * Resolves the default content into an iterable of nodes.
     *
     * @param string|\DOMNode|iterable<string|\DOMNode|null>|\Closure|null $default The default content.
     *
     * @return \Generator<int,string|\DOMNode> The resolved content.
     */
    private function resolveDefault(string|\DOMNode|iterable|\Closure|null $default): \Generator
    {
        $resolved = $default instanceof \Closure ? $default() : $default;
        if (\is_iterable($resolved)) {
            foreach ($resolved as $child) {
                if ($child === null) {
                    continue;
                }

                if ($child instanceof \DOMNode || \is_string($child)) {
                    yield $child;
                }

                throw new \TypeError(\sprintf('Invalid object type: %s.', \get_debug_type($resolved)));
            }
        } elseif (\is_string($resolved) || $resolved instanceof \DOMNode) {
            yield $resolved;
        } elseif ($resolved !== null) {
            throw new \TypeError(\sprintf('Invalid object type: %s.', \get_debug_type($resolved)));
        }
    }
}
