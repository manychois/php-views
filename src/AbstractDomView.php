<?php

declare(strict_types=1);

namespace Manychois\Views;

use Manychois\Simdom\AbstractNode;

/**
 * Base class for building view template composited of DOM nodes.
 */
abstract class AbstractDomView
{
    private static int $idCounter = 0;
    protected readonly ViewData $viewData;
    private ?self $parent = null;
    private ?self $child = null;

    /**
     * Creates a new instance of AbstractView.
     *
     * @param ViewData $viewData The data to be used in the view.
     */
    public function __construct(ViewData $viewData)
    {
        $this->viewData = $viewData;
    }

    /**
     * Returns the main content of the child view, if any.
     *
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $default The default content to return if the
     *                                                                            child view does not exist.
     *
     * @return \Generator<int,string|AbstractNode> The main content of the child view.
     */
    final public function content(string|AbstractNode|iterable|\Closure $default = []): \Generator
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
     * @param string                                                     $name    The name of the region.
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $default The default content to return if the
     *                                                                            region does not exist,
     *                                                                            or if the child view does not exist.
     *
     * @return \Generator<int,string|AbstractNode> The content of the specified region.
     */
    final public function region(string $name, string|AbstractNode|iterable|\Closure $default = []): \Generator
    {
        if ($this->child === null) {
            yield from $this->resolveDefault($default);
        } else {
            $reflection = new \ReflectionObject($this->child);
            $methodName = 'renderRegion' . \ucfirst($name);
            if ($reflection->hasMethod($methodName)) {
                /** @var \Generator<int,string|AbstractNode> $generator */
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
     * @return \Generator<int,string|AbstractNode> The combined content of this view and its parent views.
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
     * @return \Generator<int,string|AbstractNode> The main content of this view.
     */
    abstract protected function render(): \Generator;

    /**
     * Resolves the default content into an iterable of nodes.
     *
     * @param string|AbstractNode|iterable<string|AbstractNode>|\Closure $default The default content.
     *
     * @return \Generator<int,string|AbstractNode> The resolved content.
     */
    private function resolveDefault(string|AbstractNode|iterable|\Closure $default): \Generator
    {
        /** @var string|AbstractNode|iterable<string|AbstractNode> $resolved */
        $resolved = $default instanceof \Closure ? $default() : $default;
        if (\is_iterable($resolved)) {
            foreach ($resolved as $child) {
                yield $child;
            }
        } else {
            yield $resolved;
        }
    }
}
