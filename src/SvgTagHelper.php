<?php

declare(strict_types=1);

namespace Manychois\Views;

use Dom\Element;
use Dom\Node;

/**
 * Helper class for creating SVG nodes.
 *
 * @phpstan-type Content string|Node|iterable<string|Node|\Closure|null>|\Closure|null
 */
final class SvgTagHelper extends AbstractTagHelper
{
    /**
     * Create an SVG element.
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
        return $this->elementNs(NamespaceUri::SVG, $tag, $attrs, $inner);
    }

    // @codeCoverageIgnoreStart

    #region auto generated code

    /**
     * Create an `<a>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<a>` element.
     *
     * @phpstan-param Content $inner
     */
    public function a(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('a', $attrs, $inner);
    }

    /**
     * Create an `<altGlyph>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<altGlyph>` element.
     *
     * @phpstan-param Content $inner
     */
    public function altGlyph(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('altGlyph', $attrs, $inner);
    }

    /**
     * Create an `<altGlyphDef>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<altGlyphDef>` element.
     *
     * @phpstan-param Content $inner
     */
    public function altGlyphDef(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('altGlyphDef', $attrs, $inner);
    }

    /**
     * Create an `<altGlyphItem>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<altGlyphItem>` element.
     *
     * @phpstan-param Content $inner
     */
    public function altGlyphItem(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('altGlyphItem', $attrs, $inner);
    }

    /**
     * Create an `<animate>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<animate>` element.
     *
     * @phpstan-param Content $inner
     */
    public function animate(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('animate', $attrs, $inner);
    }

    /**
     * Create an `<animateColor>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<animateColor>` element.
     *
     * @phpstan-param Content $inner
     */
    public function animateColor(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('animateColor', $attrs, $inner);
    }

    /**
     * Create an `<animateMotion>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<animateMotion>` element.
     *
     * @phpstan-param Content $inner
     */
    public function animateMotion(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('animateMotion', $attrs, $inner);
    }

    /**
     * Create an `<animateTransform>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<animateTransform>` element.
     *
     * @phpstan-param Content $inner
     */
    public function animateTransform(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('animateTransform', $attrs, $inner);
    }

    /**
     * Create a `<circle>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<circle>` element.
     *
     * @phpstan-param Content $inner
     */
    public function circle(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('circle', $attrs, $inner);
    }

    /**
     * Create a `<clipPath>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<clipPath>` element.
     *
     * @phpstan-param Content $inner
     */
    public function clipPath(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('clipPath', $attrs, $inner);
    }

    /**
     * Create a `<color-profile>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<color-profile>` element.
     *
     * @phpstan-param Content $inner
     */
    public function colorProfile(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('color-profile', $attrs, $inner);
    }

    /**
     * Create a `<cursor>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<cursor>` element.
     *
     * @phpstan-param Content $inner
     */
    public function cursor(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('cursor', $attrs, $inner);
    }

    /**
     * Create a `<defs>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<defs>` element.
     *
     * @phpstan-param Content $inner
     */
    public function defs(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('defs', $attrs, $inner);
    }

    /**
     * Create a `<desc>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<desc>` element.
     *
     * @phpstan-param Content $inner
     */
    public function desc(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('desc', $attrs, $inner);
    }

    /**
     * Create an `<ellipse>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<ellipse>` element.
     *
     * @phpstan-param Content $inner
     */
    public function ellipse(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('ellipse', $attrs, $inner);
    }

    /**
     * Create a `<feBlend>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feBlend>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feBlend(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feBlend', $attrs, $inner);
    }

    /**
     * Create a `<feColorMatrix>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feColorMatrix>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feColorMatrix(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feColorMatrix', $attrs, $inner);
    }

    /**
     * Create a `<feComponentTransfer>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feComponentTransfer>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feComponentTransfer(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feComponentTransfer', $attrs, $inner);
    }

    /**
     * Create a `<feComposite>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feComposite>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feComposite(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feComposite', $attrs, $inner);
    }

    /**
     * Create a `<feConvolveMatrix>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feConvolveMatrix>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feConvolveMatrix(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feConvolveMatrix', $attrs, $inner);
    }

    /**
     * Create a `<feDiffuseLighting>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feDiffuseLighting>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feDiffuseLighting(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feDiffuseLighting', $attrs, $inner);
    }

    /**
     * Create a `<feDisplacementMap>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feDisplacementMap>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feDisplacementMap(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feDisplacementMap', $attrs, $inner);
    }

    /**
     * Create a `<feDistantLight>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feDistantLight>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feDistantLight(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feDistantLight', $attrs, $inner);
    }

    /**
     * Create a `<feFlood>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feFlood>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feFlood(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feFlood', $attrs, $inner);
    }

    /**
     * Create a `<feFuncA>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feFuncA>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feFuncA(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feFuncA', $attrs, $inner);
    }

    /**
     * Create a `<feFuncB>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feFuncB>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feFuncB(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feFuncB', $attrs, $inner);
    }

    /**
     * Create a `<feFuncG>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feFuncG>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feFuncG(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feFuncG', $attrs, $inner);
    }

    /**
     * Create a `<feFuncR>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feFuncR>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feFuncR(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feFuncR', $attrs, $inner);
    }

    /**
     * Create a `<feGaussianBlur>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feGaussianBlur>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feGaussianBlur(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feGaussianBlur', $attrs, $inner);
    }

    /**
     * Create a `<feImage>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feImage>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feImage(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feImage', $attrs, $inner);
    }

    /**
     * Create a `<feMerge>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feMerge>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feMerge(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feMerge', $attrs, $inner);
    }

    /**
     * Create a `<feMergeNode>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feMergeNode>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feMergeNode(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feMergeNode', $attrs, $inner);
    }

    /**
     * Create a `<feMorphology>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feMorphology>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feMorphology(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feMorphology', $attrs, $inner);
    }

    /**
     * Create a `<feOffset>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feOffset>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feOffset(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feOffset', $attrs, $inner);
    }

    /**
     * Create a `<fePointLight>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<fePointLight>` element.
     *
     * @phpstan-param Content $inner
     */
    public function fePointLight(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('fePointLight', $attrs, $inner);
    }

    /**
     * Create a `<feSpecularLighting>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feSpecularLighting>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feSpecularLighting(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feSpecularLighting', $attrs, $inner);
    }

    /**
     * Create a `<feSpotLight>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feSpotLight>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feSpotLight(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feSpotLight', $attrs, $inner);
    }

    /**
     * Create a `<feTile>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feTile>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feTile(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feTile', $attrs, $inner);
    }

    /**
     * Create a `<feTurbulence>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<feTurbulence>` element.
     *
     * @phpstan-param Content $inner
     */
    public function feTurbulence(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('feTurbulence', $attrs, $inner);
    }

    /**
     * Create a `<filter>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<filter>` element.
     *
     * @phpstan-param Content $inner
     */
    public function filter(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('filter', $attrs, $inner);
    }

    /**
     * Create a `<font>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<font>` element.
     *
     * @phpstan-param Content $inner
     */
    public function font(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('font', $attrs, $inner);
    }

    /**
     * Create a `<font-face>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<font-face>` element.
     *
     * @phpstan-param Content $inner
     */
    public function fontFace(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('font-face', $attrs, $inner);
    }

    /**
     * Create a `<font-face-format>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<font-face-format>` element.
     *
     * @phpstan-param Content $inner
     */
    public function fontFaceFormat(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('font-face-format', $attrs, $inner);
    }

    /**
     * Create a `<font-face-name>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<font-face-name>` element.
     *
     * @phpstan-param Content $inner
     */
    public function fontFaceName(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('font-face-name', $attrs, $inner);
    }

    /**
     * Create a `<font-face-src>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<font-face-src>` element.
     *
     * @phpstan-param Content $inner
     */
    public function fontFaceSrc(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('font-face-src', $attrs, $inner);
    }

    /**
     * Create a `<font-face-uri>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<font-face-uri>` element.
     *
     * @phpstan-param Content $inner
     */
    public function fontFaceUri(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('font-face-uri', $attrs, $inner);
    }

    /**
     * Create a `<foreignObject>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<foreignObject>` element.
     *
     * @phpstan-param Content $inner
     */
    public function foreignObject(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('foreignObject', $attrs, $inner);
    }

    /**
     * Create a `<g>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<g>` element.
     *
     * @phpstan-param Content $inner
     */
    public function g(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('g', $attrs, $inner);
    }

    /**
     * Create a `<glyph>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<glyph>` element.
     *
     * @phpstan-param Content $inner
     */
    public function glyph(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('glyph', $attrs, $inner);
    }

    /**
     * Create a `<glyphRef>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<glyphRef>` element.
     *
     * @phpstan-param Content $inner
     */
    public function glyphRef(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('glyphRef', $attrs, $inner);
    }

    /**
     * Create a `<hkern>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<hkern>` element.
     *
     * @phpstan-param Content $inner
     */
    public function hkern(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('hkern', $attrs, $inner);
    }

    /**
     * Create an `<image>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<image>` element.
     *
     * @phpstan-param Content $inner
     */
    public function image(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('image', $attrs, $inner);
    }

    /**
     * Create a `<line>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<line>` element.
     *
     * @phpstan-param Content $inner
     */
    public function line(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('line', $attrs, $inner);
    }

    /**
     * Create a `<linearGradient>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<linearGradient>` element.
     *
     * @phpstan-param Content $inner
     */
    public function linearGradient(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('linearGradient', $attrs, $inner);
    }

    /**
     * Create a `<marker>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<marker>` element.
     *
     * @phpstan-param Content $inner
     */
    public function marker(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('marker', $attrs, $inner);
    }

    /**
     * Create a `<mask>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<mask>` element.
     *
     * @phpstan-param Content $inner
     */
    public function mask(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('mask', $attrs, $inner);
    }

    /**
     * Create a `<metadata>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<metadata>` element.
     *
     * @phpstan-param Content $inner
     */
    public function metadata(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('metadata', $attrs, $inner);
    }

    /**
     * Create a `<missing-glyph>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<missing-glyph>` element.
     *
     * @phpstan-param Content $inner
     */
    public function missingGlyph(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('missing-glyph', $attrs, $inner);
    }

    /**
     * Create a `<mpath>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<mpath>` element.
     *
     * @phpstan-param Content $inner
     */
    public function mpath(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('mpath', $attrs, $inner);
    }

    /**
     * Create a `<path>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<path>` element.
     *
     * @phpstan-param Content $inner
     */
    public function path(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('path', $attrs, $inner);
    }

    /**
     * Create a `<pattern>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<pattern>` element.
     *
     * @phpstan-param Content $inner
     */
    public function pattern(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('pattern', $attrs, $inner);
    }

    /**
     * Create a `<polygon>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<polygon>` element.
     *
     * @phpstan-param Content $inner
     */
    public function polygon(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('polygon', $attrs, $inner);
    }

    /**
     * Create a `<polyline>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<polyline>` element.
     *
     * @phpstan-param Content $inner
     */
    public function polyline(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('polyline', $attrs, $inner);
    }

    /**
     * Create a `<radialGradient>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<radialGradient>` element.
     *
     * @phpstan-param Content $inner
     */
    public function radialGradient(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('radialGradient', $attrs, $inner);
    }

    /**
     * Create a `<rect>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<rect>` element.
     *
     * @phpstan-param Content $inner
     */
    public function rect(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('rect', $attrs, $inner);
    }

    /**
     * Create a `<script>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<script>` element.
     *
     * @phpstan-param Content $inner
     */
    public function script(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('script', $attrs, $inner);
    }

    /**
     * Create a `<set>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<set>` element.
     *
     * @phpstan-param Content $inner
     */
    public function set(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('set', $attrs, $inner);
    }

    /**
     * Create a `<stop>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<stop>` element.
     *
     * @phpstan-param Content $inner
     */
    public function stop(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('stop', $attrs, $inner);
    }

    /**
     * Create a `<style>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<style>` element.
     *
     * @phpstan-param Content $inner
     */
    public function style(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('style', $attrs, $inner);
    }

    /**
     * Create a `<svg>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<svg>` element.
     *
     * @phpstan-param Content $inner
     */
    public function svg(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('svg', $attrs, $inner);
    }

    /**
     * Create a `<switch>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<switch>` element.
     *
     * @phpstan-param Content $inner
     */
    public function switch(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('switch', $attrs, $inner);
    }

    /**
     * Create a `<symbol>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<symbol>` element.
     *
     * @phpstan-param Content $inner
     */
    public function symbol(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('symbol', $attrs, $inner);
    }

    /**
     * Create a `<text>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<text>` element.
     *
     * @phpstan-param Content $inner
     */
    public function text(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('text', $attrs, $inner);
    }

    /**
     * Create a `<textPath>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<textPath>` element.
     *
     * @phpstan-param Content $inner
     */
    public function textPath(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('textPath', $attrs, $inner);
    }

    /**
     * Create a `<title>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<title>` element.
     *
     * @phpstan-param Content $inner
     */
    public function title(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('title', $attrs, $inner);
    }

    /**
     * Create a `<tref>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<tref>` element.
     *
     * @phpstan-param Content $inner
     */
    public function tref(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('tref', $attrs, $inner);
    }

    /**
     * Create a `<tspan>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<tspan>` element.
     *
     * @phpstan-param Content $inner
     */
    public function tspan(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('tspan', $attrs, $inner);
    }

    /**
     * Create an `<use>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<use>` element.
     *
     * @phpstan-param Content $inner
     */
    public function use(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('use', $attrs, $inner);
    }

    /**
     * Create a `<view>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<view>` element.
     *
     * @phpstan-param Content $inner
     */
    public function view(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('view', $attrs, $inner);
    }

    /**
     * Create a `<vkern>` element.
     *
     * @param array<string,bool|string|null>                       $attrs The attributes.
     * @param string|Node|iterable<string|Node|null>|\Closure|null $inner The inner content.
     *
     * @return Element The created `<vkern>` element.
     *
     * @phpstan-param Content $inner
     */
    public function vkern(array $attrs = [], string|Node|iterable|\Closure|null $inner = null): Element
    {
        return $this->element('vkern', $attrs, $inner);
    }

    #endregion auto generated code

    // @codeCoverageIgnoreEnd
}
