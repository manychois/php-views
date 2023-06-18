<?php

declare(strict_types=1);

namespace Manychois\Views\Tests;

use Manychois\Views\AbstractView;

class ChildViewThree extends AbstractView
{
    public function getParentViewClass(): string
    {
        return MasterViewTwo::class;
    }

    #region Manychois\Views\AbstractView Members

    public function body(): string
    {
        $this->getViewModel()->title = 'Modified';
        return sprintf('<div id="%s">Child Div</div>', $this->createId());
    }

    #endregion

    private function getViewModel(): ViewModel
    {
        assert($this->viewData instanceof ViewModel);
        return $this->viewData;
    }
}
