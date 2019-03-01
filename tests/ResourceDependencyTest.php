<?php
namespace Manychois\Views\Tests;

use PHPUnit\Framework\TestCase;
use Manychois\Views\ResourceDependency;

class ResourceDependencyTest extends TestCase
{
    public function test_render()
    {
        $rd = new ResourceDependency();
        $rd->define('a', '<link rel="stylesheet" type="text/css" href="a.css" />');
        $rd->define('b', '<link rel="stylesheet" type="text/css" href="b.css" />', ['a']);
        $rd->define('c', '<link rel="stylesheet" type="text/css" href="c.css" />', ['b']);
        $rd->define('d', '<link rel="stylesheet" type="text/css" href="d.css" />');

        $rd->register('c');
        ob_start();
        $rd->render('|');
        $output = ob_get_clean();
        $this->assertSame('<link rel="stylesheet" type="text/css" href="a.css" />|<link rel="stylesheet" type="text/css" href="b.css" />|<link rel="stylesheet" type="text/css" href="c.css" />|', $output);
    }

    public function test_render_circularDependency_failed()
    {
        $rd = new ResourceDependency();
        $rd->define('a', '<link rel="stylesheet" type="text/css" href="a.css" />', ['b']);
        $rd->define('b', '<link rel="stylesheet" type="text/css" href="b.css" />', ['c']);
        $rd->define('c', '<link rel="stylesheet" type="text/css" href="c.css" />', ['a']);

        $rd->register('a');
        ob_start();
        try {
            $rd->render();
            $this->fail("Expected Exception has not been raised.");
        }
        catch (\Exception $ex) {
            $this->assertSame('Circular dependency detected on resources c and a.', $ex->getMessage());
        }
        ob_get_clean();
    }

    public function test_render_unknownDependency_failed()
    {
        $rd = new ResourceDependency();
        $rd->define('a', '<link rel="stylesheet" type="text/css" href="a.css" />', ['b']);

        $rd->register('a');
        ob_start();
        try {
            $rd->render();
            $this->fail("Expected Exception has not been raised.");
        }
        catch (\Exception $ex) {
            $this->assertSame('Resource a depends on a missing resource b.', $ex->getMessage());
        }
        ob_get_clean();
    }

    public function test_register_unknown_failed()
    {
        $rd = new ResourceDependency();
        $rd->define('a', '<link rel="stylesheet" type="text/css" href="a.css" />');
        try {
            $rd->register('b');
            $this->fail("Expected Exception has not been raised.");
        }
        catch (\Exception $ex) {
            $this->assertSame('Resource b is not defined.', $ex->getMessage());
        }
    }

    public function test_deregister()
    {
        $rd = new ResourceDependency();
        $rd->define('a', '<link rel="stylesheet" type="text/css" href="a.css" />');
        $rd->define('b', '<link rel="stylesheet" type="text/css" href="b.css" />', ['a']);
        $rd->define('c', '<link rel="stylesheet" type="text/css" href="c.css" />', ['a', 'b']);
        $rd->define('d', '<link rel="stylesheet" type="text/css" href="d.css" />');

        $rd->register('c');
        $rd->deregister('c');
        ob_start();
        $rd->render('|');
        $output = ob_get_clean();
        $this->assertSame('', $output);
    }

    public function test_deregister_tooLate_failed()
    {
        $rd = new ResourceDependency();
        $rd->define('a', '<link rel="stylesheet" type="text/css" href="a.css" />');
        $rd->define('b', '<link rel="stylesheet" type="text/css" href="b.css" />', ['a']);
        $rd->define('c', '<link rel="stylesheet" type="text/css" href="c.css" />', ['a', 'b']);
        $rd->define('d', '<link rel="stylesheet" type="text/css" href="d.css" />');

        $rd->register('c');
        ob_start();
        $rd->render();
        ob_get_clean();
        try {
            $rd->deregister('c');
            $this->fail("Expected Exception has not been raised.");
        }
        catch (\Exception $ex) {
            $this->assertSame('Resource c has outputed already.', $ex->getMessage());
        }
    }
}