# Manychois\Views
A naive PHP template library.

## How to use

Define your parent / master view:
```php
<?php
use Manychois\Views\View;

class MasterView extends View
{
    // Implement this to generate HTML of this view.
    public function renderContent()
    {
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <?php
    // Force the child view to implement this section.
    $this->section('head', true);
    ?>
</head>
<body>
    <?php
    // renderContent() of the child view will be printed here.
    $this->content();
    ?>
    <?php
    // Optional, no error if child view does not support it.
    $this->section('scripts');
    ?>
</body>
</html>
<?php
    }
}
```

And define your child view:
```php
<?php
class ChildView extends View
{
    public function __construct()
    {
        // You can choose to define the parent view elsewhere.
        $this->setParentView(new MasterView());
    }

    public function renderContent()
    {
?>
<article>
    <h1>Hellow World!</h1>
</article>
<?php
    }

    // This will feed into section('head') of the parent view
    public function render_head()
    {
        // Access model data
        printf('<title>%s</title>', $this->model);
    }
}
```

Now you are ready to generate your view:
```php
<?php
$view = new ChildView();
View::render($view, 'Title'); // model data is passed into views.
```

### Utility

There are a few classes to help you generate HTML.

#### `Manychois\Views\Esc`
It contains four static methods to escape string.
+ `Esc::html(string $text)`
+ `Esc::attr(string $text)`
+ `Esc::js(string $text)`
+ `Esc::url(string $text)`

#### `Manychois\Views\ResourceDependency`
It is used to manage stylesheet dependencies.
```php
<?php
use Manychois\Views\ResourceDependency;
$rd = new ResourceDependency();
// Give your stylesheets a name.
$rd->define('a', '<link rel="stylesheet" type="text/css" href="a.css" />');
// b requires a, so a will be printed before b.
$rd->define('b', '<link rel="stylesheet" type="text/css" href="b.css" />', ['a']);
// Pick which stylesheet to print.
$rd->register('b');
// Output the link tags.
$rd->render();
```

#### `Manychois\Views\ScriptDependency`
Similar to `ResourceDependency`, but the `define` method accept an extra argument to control if the script should be printed in the `<head>` area.
```php
$sd->define('a', '<script src="a.js"></script>', [], false);
$sd->define('b', '<script src="b.js"></script>');
$sd->register('a');
$sd->register('b');
$sd->renderHead(); // print a
$sd->render(); // print b, will also print a if renderHead() is not called.
```