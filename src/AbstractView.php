<?php

declare(strict_types=1);

namespace Manychois\Views;

use Dom\DocumentFragment;
use Dom\HTMLDocument;
use Dom\Node;

/**
 * Base class for building view template composited of DOM nodes.
 */
abstract class AbstractView
{
    private static int $idCounter = 0;
    /**
     * @var ViewData The data shared between parent and child views.
     */
    protected readonly ViewData $data;
    protected readonly HTMLDocument $doc;
    protected readonly HtmlTagHelper $html;
    protected readonly SvgTagHelper $svg;
    protected readonly MathmlTagHelper $mathml;
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
        $this->doc = $builder->getDocument();
        $this->html = new HtmlTagHelper($this->doc);
        $this->svg = new SvgTagHelper($this->doc);
        $this->mathml = new MathmlTagHelper($this->doc);

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
     * @return Node The main content of the child view.
     *
     * @phpstan-param string|Node|iterable<string|Node|\Closure|null>|\Closure|null $default
     */
    final public function content(string|Node|iterable|\Closure|null $default = null): Node
    {
        if ($this->child === null) {
            return $this->convertToDocFragment($default);
        }

        return $this->child->render();
    }

    /**
     * Returns the content of the specified region provided by the child view, if any.
     *
     * @param string $name    The name of the region.
     * @param mixed  $default The default content to return if the region does not exist, or
     *                        if the child view does not exist.
     *
     * @return Node The content of the specified region.
     *
     * @phpstan-param string|Node|iterable<string|Node|\Closure|null>|\Closure|null $default
     */
    final public function region(string $name, string|Node|iterable|\Closure|null $default = null): Node
    {
        if ($this->child === null) {
            return $this->convertToDocFragment($default);
        }

        $reflection = new \ReflectionObject($this->child);
        $methodName = 'renderRegion' . \ucfirst($name);
        if ($reflection->hasMethod($methodName)) {
            $docFrg = $this->child->$methodName();
            \assert($docFrg instanceof Node);

            return $docFrg;
        }

        return $this->convertToDocFragment($default);
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
     * @return Node The content of the partial view.
     */
    final protected function part(string $view, ViewData $data): Node
    {
        return $this->builder->populate($view, $data);
    }

    /**
     * Returns the main content of this view.
     *
     * @return Node The main content of this view.
     */
    abstract public function render(): Node;

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
     * @return DocumentFragment The resolved content.
     *
     * @phpstan-param string|Node|iterable<string|Node|\Closure|null>|\Closure|null $default
     */
    protected function convertToDocFragment(string|Node|iterable|\Closure|null $default): DocumentFragment
    {
        $doc = $this->builder->getDocument();
        $docFrg = $doc->createDocumentFragment();
        AbstractTagHelper::append($doc, $docFrg, $default);

        return $docFrg;
    }
}
