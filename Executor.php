<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Executor;

use Glory\Executor\Mission;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Finder\Finder;

/**
 * Description of Executor
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class Executor
{

    protected $eventName;
    protected $namespaces = [];

    /**
     * @var Mission[] 
     */
    protected $missions = [];

    /**
     * @var EventDispatcherInterface 
     */
    protected $eventDispatcher;

    public function execute($options = [])
    {
        $this->registerMissions();
        $this->executeMissions($options);
    }

    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
        return $this;
    }

    public function getEventDispatcher()
    {
        if (!$this->eventDispatcher) {
            $this->eventDispatcher = new EventDispatcher();
        }
        return $this->eventDispatcher;
    }

    public function addNamespace($namespace, $path)
    {
        $this->namespaces[$namespace] = $path;
        return $this;
    }

    public function removeNamespace($namespace)
    {
        if (array_key_exists($namespace, $this->namespaces)) {
            unset($this->namespaces[$namespace]);
        }
        return $this;
    }

    public function setNamespaces($namespaces)
    {
        $this->namespaces = $namespaces;
        return $this;
    }

    public function getNamespaces()
    {
        return $this->namespaces;
    }

    /**
     * @return Mission[]
     */
    public function getMissions()
    {
        if (!$this->missions) {
            foreach ($this->getNamespaces() as $namespace => $path) {
                if (!is_dir($path)) {
                    continue;
                }
                $finder = new Finder();
                $finder->files()->name('*.php')->in($path);
                foreach ($finder as $file) {
                    if ($relativePath = $file->getRelativePath()) {
                        $namespace .= '\\' . str_replace('/', '\\', $relativePath);
                    }
                    $class = $namespace . '\\' . $file->getBasename('.php');
                    $r = new \ReflectionClass($class);
                    if (!$r->isAbstract() && !$r->isInterface() && $r->isSubclassOf('Glory\\Executor\\Mission')) {
                        $mission = $r->newInstance();
                        $mission->setExecutor($this);
                        $this->missions[] = $mission;
                    }
                }
            }
        }
        return $this->missions;
    }

    protected function registerMissions()
    {
        foreach ($this->getMissions() as $mission) {
            $this->getEventDispatcher()->addListener($this->getEventName(), [new Listener($mission), 'execute'], $mission->getPriority());
        }
    }

    protected function executeMissions()
    {
        $this->getEventDispatcher()->dispatch($this->getEventName());
    }

    protected function getEventName()
    {
        if (!$this->eventName) {
            $this->eventName = 'glory.executor.' . time();
        }
        return $this->eventName;
    }

}
