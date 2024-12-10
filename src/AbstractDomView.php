<?php

declare(strict_types=1);

namespace Manychois\Views;

/**
 * Base class for building view template composited of DOM nodes.
 *
 * @phpstan-type ContentClosure \Closure(self):string|\DOMNode|iterable<string|\DOMNode|null>|null
 * @phpstan-type Content string|\DOMNode|iterable<string|\DOMNode|null>|ContentClosure|null
 */
abstract class AbstractDomView
{
    private static int $idCounter = 0;
    /**
     * @var ViewData The data shared between parent and child views.
     */
    protected readonly ViewData $data;
    private ?self $parent = null;
    private ?self $child = null;

    /**
     * Creates a new instance of AbstractView.
     *
     * @param ViewData $data The data shared between parent and child views.
     */
    public function __construct(ViewData $data)
    {
        $this->data = $data;
    }

    /**
     * Returns the parent view of this view.
     *
     * @return AbstractDomView|null The parent view of this view, or null if this view has no parent.
     */
    final public function getParent(): ?self
    {
        return $this->parent;
    }

    /**
     * Returns the child view of this view.
     *
     * @return AbstractDomView|null The child view of this view, or null if this view has no child.
     */
    final public function getChild(): ?self
    {
        return $this->child;
    }

    /**
     * Returns the main content of the child view, if any.
     *
     * @param mixed $default The default content to return if the child view does not exist.
     *
     * @return \Generator<int,string|\DOMNode|null> The main content of the child view.
     *
     * @phpstan-param Content $default
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
     * @param string $name    The name of the region.
     * @param mixed  $default The default content to return if the region does not exist, or
     *                        if the child view does not exist.
     *
     * @return \Generator<int,string|\DOMNode|null> The content of the specified region.
     *
     * @phpstan-param Content $default
     */
    final public function region(string $name, string|\DOMNode|iterable|\Closure|null $default = null): \Generator
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
     * @param mixed $default The default content.
     *
     * @return \Generator<int,string|\DOMNode> The resolved content.
     *
     * @phpstan-param Content $default
     */
    private function resolveDefault(string|\DOMNode|iterable|\Closure|null $default): \Generator
    {
        $resolved = $default instanceof \Closure ? $default($this) : $default;
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
