<?php

declare(strict_types=1);

namespace Manychois\Views\Tests;

use Manychois\Views\View;

class ChildViewTwo extends View
{
    public function getParentViewClass(): string
    {
        return MasterViewOne::class;
    }

    #region Manychois\Views\View Members

    public function body(): string
    {
        ob_start();
        ?>
<article>
    <h1>Hello World!</h1>
</article>
        <?php
        return ob_get_clean();
    }

    #endregion
}