<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Executor\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Description of OptionsEvent
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class OptionsEvent extends Event
{

    protected $options;

    public function __construct($options = [])
    {
        $this->options = $options;
    }

    public function getOptions()
    {
        return $this->options;
    }

}
