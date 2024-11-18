<?php

require_once __DIR__ . '/vendor/autoload.php';

use Manychois\Views\AbstractTextView;
use Manychois\Views\Esc;

class BaseView extends AbstractTextView
{
    public string $title;

    public function __construct(array $viewData)
    {
        parent::__construct($viewData);
        $this->title = $viewData['title'] ?? 'Default Title';
    }

    protected function render(): string
    {
        \ob_start();
        $scriptPlaceholder = $this->newPlaceholder();
?>
        <html>
        <head>
            <title><?= Esc::html($this->title) ?></title>
            <?= $scriptPlaceholder ?>
        </head>
        <body>
            <header>
                <?= $this->region('header', '<h1>Default Header</h1>') ?>
            </header>
            <main id="<?= $this->newId() ?>">
                <?= $this->content() ?>
            </main>
            <footer>
                <?= $this->region('footer') ?>
            </footer>
        </body>
        </html>
<?php
        $output = \ob_get_clean();

        $output = \str_replace($scriptPlaceholder, '<script src="script.js"></script>', $output);

        return $output;
    }
}

class HomeView extends AbstractTextView
{
    public function __construct(array $viewData)
    {
        parent::__construct($viewData);
        $parent = new BaseView($viewData);
        $this->inherit($parent);
    }

    protected function render(): string
    {
        return '<p>Welcome to the home page.</p>';
    }

    protected function renderRegionHeader(): string
    {
        return '<h1>Hello World!</h1>';
    }
}

$view = new HomeView(['title' => 'My first page']);
echo $view->fullRender() . PHP_EOL;
