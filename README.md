# Manychois\Views
A naive PHP template library. Version 2 is a complete rewrite.

## How to use

Extend `Manychois\Views\View` and define your template in `body()` function.
Use `$this->inner()` or `$this->region()` to set where you would like child content to be injected.
For child template, override `getParentViewClass()` to inform this library its parent class name.

Then you can use `View::render($templateClassName, $viewData)` for rendering.

The `tests/` folder contains some example usages of `View`.

### Utility

There are a few classes to help you generate HTML.

#### `Manychois\Views\Esc`
It contains 5 methods to escape string in different contexts.
+ `attr(string $text, bool $unquoted = false)`
+ `css(string $text)`
+ `html(string $text)`
+ `js(string $text, bool $templateMode = false)`
+ `url(string $text)`

#### `Manychois\Views\ResourceLibrary`
It is used to manage stylesheet / script dependencies.
```php
<?php
$r = new \Manychois\Views\ResourceLibrary();
$r->push('a', '<link rel="stylesheet" type="text/css" href="a.css" />', ['b']);
$r->push('b', '<link rel="stylesheet" type="text/css" href="b.css" />');
$result = $r->pull('a');
```
The above `$result` will hold this array data:
```php
[
    'b' => '<link rel="stylesheet" type="text/css" href="b.css" />',
    'a' => '<link rel="stylesheet" type="text/css" href="a.css" />'
]
```
