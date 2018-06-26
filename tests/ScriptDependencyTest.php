<?php
namespace Manychois\Views\Tests;

use PHPUnit\Framework\TestCase;
use Manychois\Views\ScriptDependency;

class ScriptDependencyTest extends TestCase
{
    public function test_renderHead_noHead_success()
    {
        $sd = new ScriptDependency();
        $sd->define('a-foot', '<script src="a.js"></script>');
        $sd->define('b-foot', '<script src="b.js"></script>', ['a-foot']);
        $sd->define('c-foot', '<script src="c.js"></script>', ['b-foot']);

        $sd->register('c-foot');

        ob_start();
        $sd->renderHead('|');
        $output = ob_get_clean();

        $this->assertSame('', $output);

        ob_start();
        $sd->render('|');
        $output = ob_get_clean();

        $this->assertSame('<script src="a.js"></script>|<script src="b.js"></script>|<script src="c.js"></script>|', $output);
    }

    public function test_renderHead_forceHead_success()
    {
        $sd = new ScriptDependency();
        $sd->define('a-foot', '<script src="a.js"></script>');
        $sd->define('b-head', '<script src="b.js"></script>', ['a-foot'], false);
        $sd->define('c-foot', '<script src="c.js"></script>', ['b-head']);

        $sd->register('c-foot');

        ob_start();
        $sd->renderHead('|');
        $output = ob_get_clean();

        $this->assertSame('<script src="a.js"></script>|<script src="b.js"></script>|', $output);

        ob_start();
        $sd->render('|');
        $output = ob_get_clean();

        $this->assertSame('<script src="c.js"></script>|', $output);
    }
}