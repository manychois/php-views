<?php

declare(strict_types=1);

namespace Manychois\Views;

/**
 * Base class for building view template composited of text contents.
 */
abstract class AbstractTextView
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
     * @param string $default The default content to return if the child view does not exist.
     *
     * @return string The main content of the child view.
     */
    final public function content(string $default = ''): string
    {
        return $this->child === null ? $default : $this->child->render();
    }

    /**
     * Returns the content of the specified region provided by the child view, if any.
     *
     * @param string $name    The name of the region.
     * @param string $default The default content to return if the region does not exist,
     *                        or if the child view does not exist.
     *
     * @return string The content of the specified region.
     */
    final public function region(string $name, string $default = ''): string
    {
        if ($this->child === null) {
            return $default;
        }

        $reflection = new \ReflectionObject($this->child);
        $methodName = 'renderRegion' . \ucfirst($name);
        if (!$reflection->hasMethod($methodName)) {
            return $default;
        }

        $result = $this->child->$methodName();
        \assert(\is_string($result));

        return $result;
    }

    /**
     * Returns the combined content of this view and its parent views.
     *
     * @return string The combined content of this view and its parent views.
     */
    final public function fullRender(): string
    {
        return $this->parent === null ? $this->render() : $this->parent->fullRender();
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
     * Generates a placeholder string consisting of 8 random characters enclosed by double angle brackets.
     *
     * @return string A placeholder string.
     */
    final protected function newPlaceholder(): string
    {
        $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $max = \strlen($chars) - 1;
        $result = '';
        for ($i = 0; $i < 8; ++$i) {
            $result .= $chars[\random_int(0, $max)];
        }

        return "《{$result}》";
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
     * @return string The main content of this view.
     */
    abstract protected function render(): string;
}
