<?php
namespace Manychois\Views;

class ResourceDependency
{
    // resource status: defined -> registered -> (enqueueing) enqueued -> printed
    protected $resources = [];

    public final function register(string $name)
    {
        if (array_key_exists($name, $this->resources)) {
            if ($this->resources[$name]['status'] === 'defined') {
                $this->resources[$name]['status'] = 'registered';
            }
        } else {
            throw new \InvalidArgumentException("Resource $name is not defined.");
        }
    }

    public final function deregister(string $name)
    {
        if (array_key_exists($name, $this->resources)) {
            $s = &$this->resources[$name]['status'];
            switch ($s) {
                case 'registered':
                    $s = 'defined';
                    break;
                case 'printed':
                    throw new \LogicException("Resource $name has outputed already.");
            }
        }
    }

    public function define(string $name, string $content, array $dependencies = [])
    {
        $this->resources[$name] = [
            'name' => $name,
            'status' => 'defined',
            'content' => $content,
            'dependencies' => $dependencies
        ];
    }

    public function render(string $eol = "\n")
    {
        $queue = [];
        foreach ($this->resources as &$resource) {
            if ($resource['status'] === 'registered') {
                $this->enqueue($resource, $queue, '');
            }
        }
        foreach ($queue as $q) {
            $resource = &$this->resources[$q];
            echo $resource['content'] . $eol;
            $resource['status'] = 'printed';
        }
    }

    protected function enqueue(&$resource, array &$queue, string $from) {
        switch ($resource['status']) {
            case 'defined':
            case 'registered':
                if ($resource['dependencies']) {
                    $resource['status'] = 'enqueueing';
                    foreach ($resource['dependencies'] as $name) {
                        if (array_key_exists($name, $this->resources)) {
                            $this->enqueue($this->resources[$name], $queue, $resource['name']);
                        } else {
                            throw new \LogicException("Resource {$resource['name']} depends on a missing resource $name.");
                        }
                    }
                }
                $queue[] = $resource['name'];
                $resource['status'] = 'enqueued';
                break;
            case 'enqueueing':
                throw new \LogicException("Circular dependency detected on resources $from and {$resource['name']}.");
        }
    }
}