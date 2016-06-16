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

use Glory\Executor\Executor;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Description of BundleExecutor
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class ContainerAwareExecutor extends Executor implements ContainerAwareInterface
{

    use ContainerAwareTrait;

    public function getContainer()
    {
        return $this->container;
    }

}
