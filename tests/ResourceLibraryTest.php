<?php

declare(strict_types=1);

namespace Manychois\Views\Tests;

use Manychois\Views\ResourceLibrary;
use PHPUnit\Framework\TestCase;

class ResourceLibraryTest extends TestCase
{
    public function test_pull_push(): void
    {
        $r = new ResourceLibrary();
        $r->push('a', '<link rel="stylesheet" type="text/css" href="a.css" />');
        $r->push('b', '<link rel="stylesheet" type="text/css" href="b.css" />', ['a']);
        $r->push('c', '<link rel="stylesheet" type="text/css" href="c.css" />', ['b']);
        $r->push('d', '<link rel="stylesheet" type="text/css" href="d.css" />');

        $result = $r->pull('c');
        $this->assertSame(['a', 'b', 'c'], array_keys($result));
        $this->assertSame('<link rel="stylesheet" type="text/css" href="a.css" />', $result['a']);
        $this->assertSame('<link rel="stylesheet" type="text/css" href="b.css" />', $result['b']);
        $this->assertSame('<link rel="stylesheet" type="text/css" href="c.css" />', $result['c']);

        $result = $r->pull('c');
        $this->assertSame([], $result);
    }

    public function test_pull_circularDependency_failed(): void
    {
        $r = new ResourceLibrary();
        $r->push('a', '<link rel="stylesheet" type="text/css" href="a.css" />', ['b']);
        $r->push('b', '<link rel="stylesheet" type="text/css" href="b.css" />', ['c']);
        $r->push('c', '<link rel="stylesheet" type="text/css" href="c.css" />', ['a']);

        $this->expectExceptionMessage('Circular dependency detected: a < c < b < a');
        $r->pull('a');
    }

    public function test_pull_unknownDependency_failed(): void
    {
        $r = new ResourceLibrary();
        $r->push('a', '<link rel="stylesheet" type="text/css" href="a.css" />', ['b']);

        $this->expectExceptionMessage('Undefined resource dependencies found: b');
        $r->pull('a');
    }
}
