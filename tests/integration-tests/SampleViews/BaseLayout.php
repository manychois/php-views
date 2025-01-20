<?php

declare(strict_types=1);

namespace Manychois\ViewTests\IntegrationTests\SampleViews;

use Dom\Node;
use Manychois\Views\AbstractView;

class BaseLayout extends AbstractView
{
    #region extends AbstractView

    public function render(): Node
    {
        $h = $this->html;
        $d = $this->data;

        return $h->html(['lang' => $d->getString('lang', 'en')], [
            $h->head([], [
                $h->meta(['charset' => 'utf-8']),
                $h->meta(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']),
                $h->title([], $d->into('page')->getString('title', 'Bootstrap demo')),
                $h->link([
                    'crossorigin' => 'anonymous',
                    'href' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
                    'integrity' => 'sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH',
                    'rel' => 'stylesheet',
                ]),
            ]),
            $h->body([], [
                $h->nav(['class' => 'navbar navbar-expand-lg bg-body-tertiary'], [
                    $h->div(['class' => 'container-fluid'], [
                        $h->a(['class' => 'navbar-brand', 'href' => '#'], 'Navbar'),
                        $h->button([
                            'aria-controls' => 'navbarNav',
                            'aria-expanded' => 'false',
                            'aria-label' => 'Toggle navigation',
                            'class' => 'navbar-toggler',
                            'data-bs-target' => '#navbarNav',
                            'data-bs-toggle' => 'collapse',
                            'type' => 'button',
                            ], [
                            $h->span(['class' => 'navbar-toggler-icon']),
                        ]),
                        $h->div(['class' => 'collapse navbar-collapse', 'id' => 'navbarNav'], $this->region('nav')),
                    ]),
                ]),
                $h->main(['class' => 'container'], $this->content($h->h1([], 'Hello, world!'))),
                $h->script([
                    'crossorigin' => 'anonymous',
                    'integrity' => 'sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz',
                    'src' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
                ]),
            ]),
        ]);
    }

    protected function getParentViewName(): ?string
    {
        return null;
    }


    #endregion extends AbstractView
}
