<?php

declare(strict_types=1);

namespace Manychois\Views\Tests;

use Manychois\Views\View;

class ChildViewThree extends View
{
    public function getParentViewClass(): string
    {
        return MasterViewTwo::class;
    }

    #region Manychois\Views\View Members

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
