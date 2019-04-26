<?php
/**
 * Created by PhpStorm.
 * User: Usuário
 * Date: 05/12/2018
 * Time: 21:40
 */

class Cell
{
    private $size;
    private $name;
    private $ocuped;

    /**
     * @return mixed
     */

    public function __construct($size)
    {
        $this->size = $size;
        $this->ocuped = 0;
    }

    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getOcuped()
    {
        return $this->ocuped;
    }

    /**
     * @param mixed $ocuped
     */
    public function setOcuped($ocuped)
    {
        $this->ocuped = $ocuped;
    }


}