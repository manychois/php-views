<?php

declare(strict_types=1);

namespace Manychois\Views;

/**
 * Base class for building view template.
 */
abstract class View
{
    private static int $idCounter = 0;
    private ?View $childView = null;
    protected mixed $viewData = null;

    /**
     * Returns the View content along with its ancestor views.
     * @param string $class The class name of the view.
     * @param mixed $data The data to be passed to the view.
     */
    final public static function render(string $class, mixed $data): string
    {
        $topView = new $class();
        assert($topView instanceof View);
        $p = $topView->getParentViewClass();
        while ($p) {
            $parent = new $p();
            assert($parent instanceof View);
            $parent->childView = $topView;
            $topView = $parent;
            $p = $topView->getParentViewClass();
        }
        $topView->viewData = $data;
        return $topView->body($data);
    }

    /**
     * Returns a unique id value.
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
        return '[Pl@ceH0lder' . random_int(0, 999999) . '}';
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
            return $this->childView->body($this->viewData);
        }
        return '';
    }

    /**
     * Returns the content of its child view, or empty if there is no child view.
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
                return call_user_func([$this->childView, "render$label"], $this->viewData);
            }
        }
        return '';
    }

    final public function getChildView(): ?View
    {
        return $this->childView;
    }

    public function getParentViewClass(): string
    {
        return '';
    }

    abstract public function body(): string;
}
