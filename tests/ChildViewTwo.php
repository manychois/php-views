<?php

declare(strict_types=1);

namespace Manychois\Views\Tests;

use Manychois\Views\AbstractView;

class ChildViewTwo extends AbstractView
{
    public function getParentViewClass(): string
    {
        return MasterViewOne::class;
    }

    #region Manychois\Views\AbstractView Members

    public function body(): string
    {
        ob_start();
        ?>
        <article>
            <h1>Hello World!</h1>
        </article>
        <?php
        $s = ob_get_clean();
        assert(is_string($s));
        return $s;
    }

    #endregion
}
