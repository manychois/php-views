<?php

declare(strict_types=1);

namespace Manychois\Views;

/**
 * Base class for building view template.
 */
abstract class View
{
    private static int $idCounter = 0;
    protected mixed $viewData = null;
    private ?self $childView = null;

    abstract public function body(): string;

    /**
     * Returns the View content along with its ancestor views.
     *
     * @param string $class The class name of the view.
     * @param mixed $data The data to be passed to the view.
     */
    final public static function render(string $class, mixed $data): string
    {
        $topView = new $class();
        assert($topView instanceof self);
        $p = $topView->getParentViewClass();
        while ($p) {
            $parent = new $p();
            assert($parent instanceof self);
            $parent->childView = $topView;
            $topView = $parent;
            $p = $topView->getParentViewClass();
        }
        $topView->viewData = $data;
        return $topView->body();
    }

    public function getParentViewClass(): string
    {
        return '';
    }

    final public function getChildView(): ?self
    {
        return $this->childView;
    }

    /**
     * Returns a unique id value.
     *
     * @param string $prefix The prefix of the id.
     */
    final protected function createId(string $prefix = 'id-'): string
    {
        return $prefix . ++self::$idCounter;
    }

    /**
     * Returns a random placeholder string.
     */
    final protected function createPlaceholder(): string
    {
        return '[Pl@ceH0lder' . random_int(0, 999_999) . '}';
    }

    /**
     * Returns the main content of its child view, or empty if there is no child view.
     * The
     */
    final protected function inner(): string
    {
        if ($this->childView) {
            if ($this->childView->viewData === null) {
                $this->childView->viewData = $this->viewData;
            }
            return $this->childView->body();
        }
        return '';
    }

    /**
     * Returns the content of its child view, or empty if there is no child view.
     *
     * @param string $label The label of the region. The parent view will call the child view's render$label method.
     * @return string The content of the region.
     */
    final protected function region(string $label): string
    {
        if ($this->childView) {
            if ($this->childView->viewData === null) {
                $this->childView->viewData = $this->viewData;
            }
            if (method_exists($this->childView, "render$label")) {
                $callable = [$this->childView, "render$label"];
                assert(is_callable($callable));
                $result = call_user_func($callable, $this->viewData);
                assert(is_string($result));
                return $result;
            }
        }
        return '';
    }
}
