<?php

declare(strict_types=1);

namespace Manychois\ViewTests\IntegrationTests\SampleViews;

use Manychois\Views\AbstractView;
use Manychois\Views\ViewData;

class FormView extends AbstractView
{
    #region extends AbstractView

    /**
     * @inheritDoc
     */
    public function render(): \Generator
    {
        $h = $this->html;
        $d = $this->data;

        yield $h->form([], function () use ($h, $d) {
            yield from $this->part(FormInput::class, new ViewData([
                'label' => 'Email address',
                'type' => 'email',
                'value' => $d->getString('email'),
            ]));
            yield from $this->part(FormInput::class, new ViewData([
                'label' => 'Password',
                'type' => 'password',
            ]));
            yield $h->button(['type' => 'submit', 'class' => 'btn btn-primary'], 'Submit');
        });
    }

    /**
     * @inheritDoc
     */
    protected function getParentViewName(): ?string
    {
        return BaseLayout::class;
    }

    #endregion extends AbstractView
}
