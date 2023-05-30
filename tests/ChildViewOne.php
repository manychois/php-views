<?php

declare(strict_types=1);

namespace Manychois\Views\Tests;

use Manychois\Views\View;

class ChildViewOne extends View
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

    public function renderHead(): string
    {
        return '<meta name="description" content="SEO is hard" />';
    }
}