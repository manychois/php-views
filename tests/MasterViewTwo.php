<?php

declare(strict_types=1);

namespace Manychois\Views\Tests;

use Manychois\Views\View;

class MasterViewTwo extends View
{
    #region Manychois\Views\View Members

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
        return strtr($s, [$title => $this->getViewModel()->title]);
    }

    #endregion

    private function getViewModel(): ViewModel
    {
        return $this->viewData;
    }
}

