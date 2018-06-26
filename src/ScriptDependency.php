<?php
namespace Manychois\Views;

class ScriptDependency extends ResourceDependency
{
    function define(string $name, string $content, array $dependencies = array(), $inFooter = true) {
        parent::define($name, $content, $dependencies);
        $this->resources[$name]['inFooter'] = $inFooter;
    }

    public function renderHead(string $eol = "\n")
    {
        $queue = [];
        foreach ($this->resources as &$resource) {
            if ($resource['status'] === 'registered') {
                $this->enqueue($resource, $queue, '');
            }
        }
        // Reset registered res to defined, and auto-register only those in head.
        foreach ($queue as $q) {
            $resource = &$this->resources[$q];
            if ($resource['inFooter']) {
                $resource['status'] = 'defined';
            } else {
                $resource['status'] = 'registered';
            }
        }

        $headQueue = [];
        foreach ($this->resources as &$resource) {
            if ($resource['status'] === 'registered') {
                $this->enqueue($resource, $headQueue, '');
            }
        }
        foreach ($headQueue as $q) {
            $resource = &$this->resources[$q];
            echo $resource['content'] . $eol;
            $resource['status'] = 'printed';
        }

        // Resume back to registered
        foreach ($queue as $q) {
            $resource = &$this->resources[$q];
            if ($resource['status'] !== 'printed') {
                $resource['status'] = 'registered';
            }
        }
    }
}