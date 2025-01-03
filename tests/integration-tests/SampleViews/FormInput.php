<?php

declare(strict_types=1);

namespace Manychois\ViewTests\IntegrationTests\SampleViews;

use Manychois\Views\AbstractView;

class FormInput extends AbstractView
{
    #region extends AbstractView

    /**
     * @inheritDoc
     */
    public function render(): \Generator
    {
        $h = $this->html;
        $d = $this->data;
        $id = $this->newId();

        yield $h->div(['class' => $d->getString('class', 'mb-3')], [
            $h->label(['for' => $id, 'class' => 'form-label'], $d->getString('label')),
            $h->input(
                ['class' => 'form-control',
                'id' => $id,
                'type' => $d->getString('type'),
                'value' => $d->getString(
                    'value',
                    ''
                ),
                ]
            ),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getParentViewName(): ?string
    {
        return null;
    }

    #endregion extends AbstractView
}
