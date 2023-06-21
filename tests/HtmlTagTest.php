<?php

declare(strict_types=1);

namespace Manychois\Views\Tests;

use Manychois\Views\HtmlTag;
use Manychois\Views\HtmlTagRenderMode;
use PHPUnit\Framework\TestCase;

class HtmlTagTest extends TestCase
{
    public function testRender_OpenTag_OK(): void
    {
        $tag = new HtmlTag('form');
        $tag->attrs['method'] = 'post';
        $tag->attrs['action'] = 'https://example.com';
        $tag->attrs['id'] = 'my-id';
        static::assertEquals(
            '<form method="post" action="https://example.com" id="my-id">',
            $tag->render(HtmlTagRenderMode::OpenTag),
        );
    }

    public function testRender_AttrOnly_OK(): void
    {
        $tag = new HtmlTag('form');
        $tag->attrs['method'] = 'post';
        $tag->attrs['action'] = 'https://example.com';
        $tag->attrs['id'] = 'my-id';
        static::assertEquals(
            'method="post" action="https://example.com" id="my-id"',
            $tag->render(HtmlTagRenderMode::AttrOnly),
        );
    }

    public function testRender_All_OK(): void
    {
        $form = new HtmlTag('form');

        $label = new HtmlTag('label');
        $label->attrs['for'] = 'text-name';
        $label->children[] = 'First name & last name';

        $input = new HtmlTag('input');
        $input->attrs['type'] = 'text';
        $input->attrs['name'] = 'name';
        $input->attrs['id'] = 'text-name';

        $button = new HtmlTag('button');
        $button->attrs['type'] = 'submit';
        $button->attrs['disabled'] = null;
        $button->children[] = 'Submit';

        $form->children[] = $label;
        $form->children[] = $input;
        $form->children[] = $button;

        static::assertEquals(
            '<form><label for="text-name">First name &amp; last name</label><input type="text" name="name" id="text-name"><button type="submit" disabled>Submit</button></form>',
            $form->render(),
        );
    }

    public function testRender_ScriptTag_OK(): void
    {
        $tag = new HtmlTag('script');
        $tag->children[] = 'alert("Hello world!");';
        $tag->children[] = new HtmlTag('junk');
        static::assertEquals(
            '<script>alert("Hello world!");</script>',
            $tag->render(),
        );
    }
}
