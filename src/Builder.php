<?php

declare(strict_types=1);

namespace Manychois\Views;

/**
 * Represents a builder that instantiates and renders views.
 */
class Builder
{
    private \DOMDocument $document;

    /**
     * Returns the combined content of this view and its parent views.
     *
     * @param string   $view The name of the view to render.
     * @param ViewData $data The data to pass to the view.
     *
     * @return \Generator<int,string|\DOMNode|null> The combined content of this view and its parent views.
     */
    final public function populate(string $view, ViewData $data): \Generator
    {
        $instance = $this->resolve($view, $data);
        $topmost = $instance;
        while ($topmost->getParent() !== null) {
            $topmost = $topmost->getParent();
        }

        yield from $topmost->render();
    }

    /**
     * Initializes the document before rendering the views.
     */
    final public function prepareDocument(): void
    {
        $this->document = new \DOMDocument();
        $doctype = $this->document->implementation->createDocumentType('html');
        $this->document->appendChild($doctype);
    }

    /**
     * Returns the current document that is being built.
     *
     * @return \DOMDocument The current document that is being built.
     */
    public function getDocument(): \DOMDocument
    {
        return $this->document;
    }

    /**
     * Instantiates a view with the specified name and data.
     *
     * @param string   $view The name of the view to instantiate.
     * @param ViewData $data The data to pass to the view.
     *
     * @return AbstractView The instantiated view.
     */
    public function resolve(string $view, ViewData $data): AbstractView
    {
        $instance = new $view($this, $data);
        if (!$instance instanceof AbstractView) {
            throw new \TypeError(\sprintf('The view must be an instance of %s.', AbstractView::class));
        }

        return $instance;
    }
}
