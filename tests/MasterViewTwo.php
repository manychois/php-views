<?php

declare(strict_types=1);

namespace Manychois\Views\Tests;

use Manychois\Views\AbstractView;

class MasterViewTwo extends AbstractView
{
    #region Manychois\Views\AbstractView Members

    public function body(): string
    {
        ob_start();
        $title = $this->createPlaceholder();
        ?>
        <!doctype html>
        <html lang="en">

        <head>
            <meta charset="utf-8" />
            <title><?= $title ?></title>
        </head>

        <body>
            <?= $this->inner() ?>
            <div id="<?= $this->createId() ?>">Master Div</div>
        </body>

        </html>
        <?php
        $s = ob_get_clean();
        assert(is_string($s));
        return strtr($s, [$title => $this->getViewModel()->title]);
    }

    #endregion

    private function getViewModel(): ViewModel
    {
        assert($this->viewData instanceof ViewModel);
        return $this->viewData;
    }
}
