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

use Symfony\Component\EventDispatcher\Event;
use Glory\Executor\OptionsEvent;

/**
 * Description of Listener
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class Listener
{

    /**
     * @var Mission 
     */
    protected $mission;

    /**
     *
     * @var Executor 
     */
    protected $executor;

    public function __construct(Mission $mission)
    {
        $this->mission = $mission;
        $this->executor = $mission->getExecutor();
    }

    public function execute(Event $event)
    {
        if ($event instanceof OptionsEvent) {
            $this->mission->setOptions($event->getOptions());
        }
        if ($isValid = $this->mission->isValid()) {
            $this->mission->execute();
        }
        $this->mission->setResult($isValid);
    }

}
