<?php

declare(strict_types=1);

namespace Manychois\Views;

use Dom\Element;
use Dom\Node;

/**
 * Helper class for creating MathML nodes.
 *
 * @phpstan-type Content string|Node|iterable<string|Node|\Closure|null>|\Closure|null
 */
final class MathmlTagHelper extends AbstractTagHelper
{
    /**
     * Create a MathML element.
     *
     * @param string                                               $tag   The tag name.
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created element.
     *
     * @phpstan-param Content $inner
     */
    public function element(string $tag, array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->elementNs(NamespaceUri::MATHML, $tag, $attrs, $inner);
    }

    // @codeCoverageIgnoreStart

    #region auto generated code

    /**
     * Create an `<annotation-xml>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<annotation-xml>` element.
     *
     * @phpstan-param Content $inner
     */
    public function annotationXml(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('annotation-xml', $attrs, $inner);
    }

    /**
     * Create an `<annotation>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<annotation>` element.
     *
     * @phpstan-param Content $inner
     */
    public function annotation(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('annotation', $attrs, $inner);
    }

    /**
     * Create a `<math>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<math>` element.
     *
     * @phpstan-param Content $inner
     */
    public function math(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('math', $attrs, $inner);
    }

    /**
     * Create a `<merror>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<merror>` element.
     *
     * @phpstan-param Content $inner
     */
    public function merror(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('merror', $attrs, $inner);
    }

    /**
     * Create a `<mfrac>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<mfrac>` element.
     *
     * @phpstan-param Content $inner
     */
    public function mfrac(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('mfrac', $attrs, $inner);
    }

    /**
     * Create a `<mi>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<mi>` element.
     *
     * @phpstan-param Content $inner
     */
    public function mi(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('mi', $attrs, $inner);
    }

    /**
     * Create a `<mmultiscripts>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<mmultiscripts>` element.
     *
     * @phpstan-param Content $inner
     */
    public function mmultiscripts(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('mmultiscripts', $attrs, $inner);
    }

    /**
     * Create a `<mn>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<mn>` element.
     *
     * @phpstan-param Content $inner
     */
    public function mn(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('mn', $attrs, $inner);
    }

    /**
     * Create a `<mo>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<mo>` element.
     *
     * @phpstan-param Content $inner
     */
    public function mo(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('mo', $attrs, $inner);
    }

    /**
     * Create a `<mover>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<mover>` element.
     *
     * @phpstan-param Content $inner
     */
    public function mover(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('mover', $attrs, $inner);
    }

    /**
     * Create a `<mpadded>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<mpadded>` element.
     *
     * @phpstan-param Content $inner
     */
    public function mpadded(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('mpadded', $attrs, $inner);
    }

    /**
     * Create a `<mphantom>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<mphantom>` element.
     *
     * @phpstan-param Content $inner
     */
    public function mphantom(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('mphantom', $attrs, $inner);
    }

    /**
     * Create a `<mprescripts>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<mprescripts>` element.
     *
     * @phpstan-param Content $inner
     */
    public function mprescripts(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('mprescripts', $attrs, $inner);
    }

    /**
     * Create a `<mroot>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<mroot>` element.
     *
     * @phpstan-param Content $inner
     */
    public function mroot(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('mroot', $attrs, $inner);
    }

    /**
     * Create a `<mrow>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<mrow>` element.
     *
     * @phpstan-param Content $inner
     */
    public function mrow(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('mrow', $attrs, $inner);
    }

    /**
     * Create a `<ms>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<ms>` element.
     *
     * @phpstan-param Content $inner
     */
    public function ms(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('ms', $attrs, $inner);
    }

    /**
     * Create a `<mspace>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<mspace>` element.
     *
     * @phpstan-param Content $inner
     */
    public function mspace(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('mspace', $attrs, $inner);
    }

    /**
     * Create a `<msqrt>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<msqrt>` element.
     *
     * @phpstan-param Content $inner
     */
    public function msqrt(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('msqrt', $attrs, $inner);
    }

    /**
     * Create a `<mstyle>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<mstyle>` element.
     *
     * @phpstan-param Content $inner
     */
    public function mstyle(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('mstyle', $attrs, $inner);
    }

    /**
     * Create a `<msub>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<msub>` element.
     *
     * @phpstan-param Content $inner
     */
    public function msub(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('msub', $attrs, $inner);
    }

    /**
     * Create a `<msubsup>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<msubsup>` element.
     *
     * @phpstan-param Content $inner
     */
    public function msubsup(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('msubsup', $attrs, $inner);
    }

    /**
     * Create a `<msup>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<msup>` element.
     *
     * @phpstan-param Content $inner
     */
    public function msup(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('msup', $attrs, $inner);
    }

    /**
     * Create a `<mtable>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<mtable>` element.
     *
     * @phpstan-param Content $inner
     */
    public function mtable(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('mtable', $attrs, $inner);
    }

    /**
     * Create a `<mtd>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<mtd>` element.
     *
     * @phpstan-param Content $inner
     */
    public function mtd(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('mtd', $attrs, $inner);
    }

    /**
     * Create a `<mtext>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<mtext>` element.
     *
     * @phpstan-param Content $inner
     */
    public function mtext(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('mtext', $attrs, $inner);
    }

    /**
     * Create a `<mtr>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<mtr>` element.
     *
     * @phpstan-param Content $inner
     */
    public function mtr(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('mtr', $attrs, $inner);
    }

    /**
     * Create a `<munder>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<munder>` element.
     *
     * @phpstan-param Content $inner
     */
    public function munder(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('munder', $attrs, $inner);
    }

    /**
     * Create a `<munderover>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<munderover>` element.
     *
     * @phpstan-param Content $inner
     */
    public function munderover(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('munderover', $attrs, $inner);
    }

    /**
     * Create a `<semantics>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<semantics>` element.
     *
     * @phpstan-param Content $inner
     */
    public function semantics(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('semantics', $attrs, $inner);
    }

    #endregion auto generated code

    // @codeCoverageIgnoreEnd
}
