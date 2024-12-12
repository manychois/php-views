<?php

declare(strict_types=1);

namespace Manychois\Views;

/**
 * Consolidates the building and printing of views.
 */
class Renderer
{
    public readonly Builder $builder;
    public readonly Printer $printer;

    /**
     * Creates a new instance of Renderer.
     *
     * @param Builder $builder The builder that creates views.
     * @param Printer $printer The printer that prints views.
     */
    public function __construct(Builder $builder, Printer $printer)
    {
        $this->builder = $builder;
        $this->printer = $printer;
    }

    /**
     * Renders the specified view with the specified data.
     *
     * @param string   $view The name of the view to render.
     * @param ViewData $data The data to pass to the view.
     *
     * @return string The rendered view content.
     */
    public function render(string $view, ViewData $data): string
    {
        $this->builder->prepareDocument();
        $doc = $this->builder->getDocument();
        foreach ($this->builder->populate($view, $data) as $node) {
            if ($node === null || \is_string($node) || $node instanceof \DOMText) {
                continue;
            }
            $doc->appendChild($node);
        }

        return $this->printer->print($doc);
    }
}
