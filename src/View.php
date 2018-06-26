<?php
namespace Manychois\Views;

abstract class View
{
    public static function render(View $view, $model = null)
    {
        $view->model = $model;
        $topmost = $view;
        while ($topmost->parent) {
            $topmost = $topmost->parent;
            $topmost->model = $model;
        }
        $topmost->renderContent();
    }

    /**
     * Parent view.
     * @var null|View
     */
    private $parent = null;

    /**
     * Child view.
     * @var null|View
     */
    private $child = null;

    /**
     * Model data, passed during the render process.
     * @var mixed
     */
    protected $model = null;

    /**
     * Calls renderContent() of the child view.
     */
    public final function content()
    {
        if ($this->child) $this->child->renderContent();
    }

    /**
     * Returns whether a child view is defined during the render process.
     * @return boolean True if a child view is defined.
     */
    public final function hasChild() : bool
    {
        return !is_null($this->child);
    }

    /**
     * Returns whether a child view is defined and has the method render_$sectionName defined.
     * @return boolean True if a child view contains the method render_$sectionName.
     */
    public final function hasChildSection(string $sectionName) : bool
    {
        return !is_null($this->child) && method_exists($this->child, "render_$sectionName");
    }

    /**
     * Calls render_$sectionName of the child view.
     * @param string $sectionName Name of the section.
     * @param bool $required Set true to throw exception if the child view does not define the render_$sectionName method.
     */
    public final function section(string $sectionName, bool $required = false)
    {
        if ($this->child) {
            if (method_exists($this->child, "render_$sectionName")) {
                call_user_func([$this->child, "render_$sectionName"]);
            } elseif ($required) {
                $childClass = get_class($this->child);
                throw new \BadMethodCallException("Method render_$sectionName is not defined in the child view $childClass.");
            }
        } elseif ($required) {
            $className = get_class($this);
            throw new \BadMethodCallException("Child view is undefined for view $className.");
        }
    }

    /**
     * Sets the parent view.
     * @param View $parent Parent view.
     */
    public final function setParentView(View $parent)
    {
        $parent->child = $this;
        $this->parent = $parent;
    }

    /**
     * Outputs the content of this view.
     */
    public abstract function renderContent();
}