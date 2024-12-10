<?php

declare(strict_types=1);

namespace Manychois\ViewTests\UnitTests;

use DateTime;
use Manychois\Views\ViewData;
use PHPUnit\Framework\TestCase;

class ViewDataTest extends TestCase
{
    public function testConstructWithNonAssociatvieArrayExpectsError(): void
    {
        $this->expectException(\TypeError::class);
        $this->expectExceptionMessage('Data must be an associative array.');
        // @phpstan-ignore argument.type
        new ViewData(['a', 'b', 'c']);
    }

    public function testClear(): void
    {
        $vd = new ViewData(['a' => 'apple', 'b' => 'banana']);
        static::assertSame('apple', $vd->get('a'));
        static::assertSame('banana', $vd->get('b'));
        $vd->clear();
        static::assertNull($vd->get('a'));
        static::assertNull($vd->get('b'));
    }

    public function testDelete(): void
    {
        $vd = new ViewData(['a' => 'apple', 'b' => 'banana']);
        static::assertSame('apple', $vd->get('a'));
        static::assertSame('banana', $vd->get('b'));
        $vd->delete('a');
        static::assertNull($vd->get('a'));
        static::assertSame('banana', $vd->get('b'));
        $vd->delete('b');
        static::assertNull($vd->get('b'));
        // no error
        $vd->delete('c');
    }

    public function testGetArray(): void
    {
        $letters = static function () {
            yield 'a';
            yield 'b';
            yield 'c';
        };
        $vd = new ViewData([
            'letters' => $letters(),
            'numbers' => [1, 2, 3],
            'object' => $this,
        ]);

        static::assertSame([1, 2, 3], $vd->getArray('numbers'));
        static::assertSame(['a', 'b', 'c'], $vd->getArray('letters'));
        static::assertSame([], $vd->getArray('nonexistent'));
        static::assertSame([], $vd->getArray('object'));
    }

    public function testGetBool(): void
    {
        $vd = new ViewData([
            'a' => true,
            'b' => false,
            'c' => 'on',
            'd' => 'off',
            'e' => 1,
            'f' => 0,
            'g' => null,
        ]);

        static::assertTrue($vd->getBool('a'));
        static::assertFalse($vd->getBool('b'));
        static::assertTrue($vd->getBool('c'));
        static::assertFalse($vd->getBool('d'));
        static::assertTrue($vd->getBool('e'));
        static::assertFalse($vd->getBool('f'));
        static::assertFalse($vd->getBool('g'));
    }

    public function testGetFloat(): void
    {
        $vd = new ViewData([
            'a' => -1,
            'b' => 3.14,
            'c' => '5abc',
            'd' => 'Not a number',
            'e' => null,
            'f' => [1],
        ]);

        static::assertSame(-1.0, $vd->getFloat('a'));
        static::assertSame(3.14, $vd->getFloat('b'));
        static::assertSame(5.0, $vd->getFloat('c'));
        static::assertSame(0.0, $vd->getFloat('d'));
        static::assertSame(0.0, $vd->getFloat('e'));
        static::assertSame(0.0, $vd->getFloat('f'));
    }

    public function testGetInt(): void
    {
        $vd = new ViewData([
            'a' => -1,
            'b' => 3.5,
            'c' => '5abc',
            'd' => 'Not a number',
            'e' => null,
            'f' => [1],
        ]);

        static::assertSame(-1, $vd->getInt('a'));
        static::assertSame(3, $vd->getInt('b'));
        static::assertSame(5, $vd->getInt('c'));
        static::assertSame(0, $vd->getInt('d'));
        static::assertSame(0, $vd->getInt('e'));
        static::assertSame(0, $vd->getInt('f'));
    }

    public function testGetObject(): void
    {
        $vd = new ViewData([
            'a' => $this,
        ]);

        static::assertSame($this, $vd->getObject('a', self::class));
    }

    public function testGetObjectWithInvalidType(): void
    {
        $this->expectException(\TypeError::class);
        $this->expectExceptionMessage('Invalid type. Expected ' . self::class . ', found string.');
        $vd = new ViewData([
            'a' => 'string',
        ]);
        $vd->getObject('a', self::class);
    }

    public function testGetString(): void
    {
        $vd = new ViewData([
            'a' => 'apple',
            'b' => 123,
            'c' => null,
            'd' => $this,
            'e' => new DateTime('2024-12-01'),
        ]);

        static::assertSame('apple', $vd->getString('a'));
        static::assertSame('123', $vd->getString('b'));
        static::assertSame('', $vd->getString('c'));
        static::assertSame('[Manychois\ViewTests\UnitTests\ViewDataTest]', $vd->getString('d'));
        static::assertSame('default', $vd->getString('e', 'default'));
    }

    public function testHas(): void
    {
        $vd = new ViewData([
            'a' => 'apple',
            'b' => null,
        ]);

        static::assertTrue($vd->has('a'));
        static::assertFalse($vd->has('b'));
        static::assertTrue($vd->has('b', false));
        static::assertFalse($vd->has('c'));
    }

    public function testInto(): void
    {
        $vd = new ViewData([
            'a' => [
                'ab' => 'absolute',
            ],
        ]);

        static::assertSame('absolute', $vd->into('a')->getString('ab'));
        $vd->into('a')->set('ab', 'abandon');
        static::assertSame('abandon', $vd->into('a')->getString('ab'));
        $vd->into('b')->set('ba', 'back');
        static::assertSame('back', $vd->into('b')->getString('ba'));
    }

    public function testIntoWithInvalidType(): void
    {
        $this->expectException(\TypeError::class);
        $this->expectExceptionMessage('Invalid type. Expected array, found string.');
        $vd = new ViewData([
            'a' => 'string',
        ]);
        $vd->into('a');
    }

    public function testLoopObjects(): void
    {
        $vd = new ViewData([
            'a' => [
                new \DateTime('2024-12-01'),
                new \DateTime('2024-12-02'),
                new \DateTime('2024-12-03'),
            ],
        ]);

        $actual = [];
        foreach ($vd->loopObjects('a', \DateTime::class) as $object) {
            $actual[] = $object->format('Y-m-d');
        }
        static::assertSame('2024-12-01,2024-12-02,2024-12-03', \implode(',', $actual));

        $actual = [];
        foreach ($vd->loopObjects('b', \DateTime::class) as $object) {
            $actual[] = $object->format('Y-m-d');
        }
        static::assertSame('', \implode(',', $actual));
    }

    public function testLoopObjectsWithInvalidType(): void
    {
        $this->expectException(\TypeError::class);
        $this->expectExceptionMessage('Invalid type in object list. Expected DateTime, found string.');
        $vd = new ViewData([
            'a' => ['string'],
        ]);
        \iterator_to_array($vd->loopObjects('a', \DateTime::class));
    }

    public function testScope(): void
    {
        $vd = new ViewData([
            'a' => 'apple',
        ]);
        $vd->scope(['a' => 'alpha', 'b' => 'beta'], static function (ViewData $vd2) use ($vd): void {
            static::assertSame($vd, $vd2);
            static::assertSame('alpha', $vd2->getString('a'));
            static::assertSame('beta', $vd2->getString('b'));
        });

        static::assertSame('apple', $vd->getString('a'));
        static::assertSame('', $vd->getString('b'));
    }

    public function __toString(): string
    {
        return '[' . self::class . ']';
    }
}
