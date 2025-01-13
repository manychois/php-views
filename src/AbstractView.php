<?php

declare(strict_types=1);

namespace Manychois\Views;

use Dom\Node;

/**
 * Base class for building view template composited of DOM nodes.
 *
 * @phpstan-type SimpleContent string|Node|null
 * @phpstan-type ContentClosure \Closure(self):SimpleContent|iterable<SimpleContent>
 * @phpstan-type Content SimpleContent|iterable<SimpleContent>|ContentClosure
 */
abstract class AbstractView
{
    private static int $idCounter = 0;
    /**
     * @var ViewData The data shared between parent and child views.
     */
    protected readonly ViewData $data;
    protected readonly HtmlTagHelper $html;
    private readonly Builder $builder;
    private readonly ?self $parent;
    private ?self $child = null;

    /**
     * Creates a new instance of AbstractView.
     *
     * @param Builder  $builder The builder that creates this view.
     * @param ViewData $data    The data shared between parent and child views.
     */
    public function __construct(Builder $builder, ViewData $data)
    {
        $this->builder = $builder;
        $this->html = new HtmlTagHelper($builder->getDocument());
        $this->data = $data;
        $parentClass = $this->getParentViewName();
        $this->parent = $parentClass === null ? null : $builder->resolve($parentClass, $data);
        if ($this->parent === null) {
            return;
        }

        $this->parent->child = $this;
    }

    /**
     * Returns the parent view of this view.
     *
     * @return AbstractView|null The parent view of this view, or null if this view has no parent.
     */
    final public function getParent(): ?self
    {
        return $this->parent;
    }

    /**
     * Returns the child view of this view.
     *
     * @return AbstractView|null The child view of this view, or null if this view has no child.
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
     * @return \Generator<int,string|Node|null> The main content of the child view.
     *
     * @phpstan-param Content $default
     */
    final public function content(string|Node|iterable|\Closure|null $default = null): \Generator
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
     * @return \Generator<int,string|Node|null> The content of the specified region.
     *
     * @phpstan-param Content $default
     */
    final public function region(string $name, string|Node|iterable|\Closure|null $default = null): \Generator
    {
        if ($this->child === null) {
            yield from $this->resolveDefault($default);
        } else {
            $reflection = new \ReflectionObject($this->child);
            $methodName = 'renderRegion' . \ucfirst($name);
            if ($reflection->hasMethod($methodName)) {
                /** @var \Generator<int,string|Node|null> $generator */
                $generator = $this->child->$methodName();

                yield from $generator;
            } else {
                yield from $this->resolveDefault($default);
            }
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
     * Renders a partial view.
     *
     * @param string   $view The name of the view to render.
     * @param ViewData $data The data to pass to the view.
     *
     * @return \Generator<int,string|Node|null> The content of the partial view.
     */
    final protected function part(string $view, ViewData $data): \Generator
    {
        yield from $this->builder->populate($view, $data);
    }

    /**
     * Returns the main content of this view.
     *
     * @return \Generator<int,string|Node|null> The main content of this view.
     */
    abstract public function render(): \Generator;

    /**
     * Determines the parent view of this view.
     * This will be called by the constructor to instantiate the parent view.
     *
     * @return string|null The parent view of this view, or null if this view has no parent.
     */
    abstract protected function getParentViewName(): ?string;

    /**
     * Resolves the default content into an iterable of nodes.
     *
     * @param mixed $default The default content.
     *
     * @return \Generator<int,string|Node> The resolved content.
     *
     * @phpstan-param Content $default
     */
    private function resolveDefault(string|Node|iterable|\Closure|null $default): \Generator
    {
        $resolved = $default instanceof \Closure ? $default($this) : $default;
        if (\is_iterable($resolved)) {
            foreach ($resolved as $child) {
                if ($child === null) {
                    continue;
                }

                if ($child instanceof Node || \is_string($child)) {
                    yield $child;
                }

                throw new \TypeError(\sprintf('Invalid object type: %s.', \get_debug_type($resolved)));
            }
        } elseif (\is_string($resolved) || $resolved instanceof Node) {
            yield $resolved;
        } elseif ($resolved !== null) {
            throw new \TypeError(\sprintf('Invalid object type: %s.', \get_debug_type($resolved)));
        }
    }
}
