<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Executor\Bundle;

use Glory\Executor\Mission;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Description of ContainerAwareMission
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
abstract class ContainerAwareMission extends Mission implements ContainerAwareInterface
{

    use ContainerAwareTrait;

    /**
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        if (null === $this->container) {
            $this->container = $this->getExecutor()->getContainer();
        }

        return $this->container;
    }

}
