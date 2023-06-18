<?php

declare(strict_types=1);

namespace Manychois\Views\Tests;

use Manychois\Views\ResourceLibrary;
use PHPUnit\Framework\TestCase;

class ResourceLibraryTest extends TestCase
{
    public function test_peek(): void
    {
        $r = new ResourceLibrary();
        $r->push('a', '<link rel="stylesheet" type="text/css" href="a.css" />');
        $r->push('b', '<link rel="stylesheet" type="text/css" href="b.css" />');
        $found = $r->peek(static fn ($key, $value) => strpos($value, 'b.css') !== false);
        $this->assertSame('b', $found);
        $found = $r->peek(static fn ($key, $value) => strpos($value, 'c.css') !== false);
        $this->assertNull($found);
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

    public function test_pull_unknownResource_failed(): void
    {
        $r = new ResourceLibrary();
        $r->push('a', '<link rel="stylesheet" type="text/css" href="a.css" />');

        $this->expectExceptionMessage('Undefined resource found: b');
        $r->pull('b');
    }

    public function test_push_existing_returnsFalse(): void
    {
        $r = new ResourceLibrary();
        $pushed = $r->push('a', '<link rel="stylesheet" type="text/css" href="a.css" />');
        $this->assertTrue($pushed);
        $pushed = $r->push('a', '<link rel="stylesheet" type="text/css" href="a2.css" />');
        $this->assertFalse($pushed);
        $out = $r->pull('a');
        $this->assertSame('<link rel="stylesheet" type="text/css" href="a.css" />', $out['a']);
    }

    public function test_push_selfRef_failed(): void
    {
        $r = new ResourceLibrary();
        $this->expectExceptionMessage('Resource a cannot depend on itself.');
        $r->push('a', '<link rel="stylesheet" type="text/css" href="a.css" />', ['a']);
    }

    public function test_remove(): void
    {
        $r = new ResourceLibrary();
        $removed = $r->remove('a');
        $this->assertFalse($removed);
        $r->push('a', '<link rel="stylesheet" type="text/css" href="a.css" />');
        $removed = $r->remove('a');
        $this->assertTrue($removed);
    }

    public function test_resolve_caseOne(): void
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

    public function test_resolve_caseTwo(): void
    {
        $r = new ResourceLibrary();
        $r->push('a', '<link rel="stylesheet" type="text/css" href="a.css" />');
        $r->push('b', '<link rel="stylesheet" type="text/css" href="b.css" />', ['a']);
        $r->push('c', '<link rel="stylesheet" type="text/css" href="c.css" />', ['b']);
        $r->push('d', '<link rel="stylesheet" type="text/css" href="d.css" />', ['c', 'b']);

        $result = $r->pull('d');
        $this->assertSame(['a', 'b', 'c', 'd'], array_keys($result));
    }

    public function test_resolve_caseThree(): void
    {
        $r = new ResourceLibrary();
        $r->push('a', '<link rel="stylesheet" type="text/css" href="a.css" />');
        $r->push('b', '<link rel="stylesheet" type="text/css" href="b.css" />', ['a']);
        $r->push('c', '<link rel="stylesheet" type="text/css" href="c.css" />');
        $r->push('d', '<link rel="stylesheet" type="text/css" href="d.css" />', ['c']);
        $r->push('e', '<link rel="stylesheet" type="text/css" href="e.css" />', ['b', 'd']);

        $result = $r->pull('e');
        $this->assertSame(['a', 'b', 'c', 'd', 'e'], array_keys($result));
    }
}
