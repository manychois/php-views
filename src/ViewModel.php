<?php
namespace Manychois\Views;

class ViewModel
{
    /**
     * @var string
     */
    public $title = '';
    /**
     * @var string
     */
    public $canonicalLink = '';
    /**
     * @var string
     */
    public $metaDescription = '';
    /**
     * @var ResourceDependency
     */
    public $styles;
    /**
     * @var ScriptDependency
     */
    public $scripts;
}