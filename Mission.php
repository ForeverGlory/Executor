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

use Glory\Executor\Executor;

/**
 * Description of Mission
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
abstract class Mission
{

    protected $options = [];
    protected $executor;
    protected $result;

    public function getPriority()
    {
        return 0;
    }

    public function isValid()
    {
        return true;
    }

    abstract public function execute();

    public function setOptions($options = [])
    {
        $this->options = $options;
        return $this;
    }

    public function setExecutor(Executor $executor)
    {
        $this->executor = $executor;
        return $this;
    }

    /**
     * @param Executor
     */
    public function getExecutor()
    {
        return $this->executor;
    }

    /**
     * set mission result
     */
    final public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }

    /**
     * 执行结果
     * 
     * 通过isValid()，执行
     * 未过isValid()，不执行
     * 
     * @return boolean
     */
    final public function getResult()
    {
        return $this->result;
    }

}
