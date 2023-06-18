<?php

declare(strict_types=1);

namespace Manychois\Views\Tests;

use Manychois\Views\AbstractView;

class MasterViewOne extends AbstractView
{
    #region Manychois\Views\AbstractView Members

    public function body(): string
    {
        $vm = $this->getViewModel();
        ob_start();
        ?>
        <!doctype html>
        <html lang="en">

        <head>
            <meta charset="utf-8" />
            <title>
                <?php echo $vm->title; ?>
            </title>
            <?= $this->region('Head') ?>
        </head>

        <body>
            <main>
                <?php
                if ($this->getChildView()) {
                    echo $this->inner();
                } else {
                    echo 'No content';
                }
                ?>
            </main>
            <?php
            $script = $this->region('Scripts');
            if ($script) {
                echo $script;
            } else {
                echo '<!-- No JavaScript -->';
            }
            ?>
        </body>

        </html>
        <?php
        $s = ob_get_clean();
        assert(is_string($s));
        return $s;
    }

    #endregion

    private function getViewModel(): ViewModel
    {
        assert($this->viewData instanceof ViewModel);
        return $this->viewData;
    }
}
