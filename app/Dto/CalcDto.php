<?php

namespace App\Dto;

class CalcDto
{
    private int $num1 = 0;
    private int $num2 = 0;
    private String $selected = "";
    private String $result = "";
    private String $msg = "";
    private $select = ["+", "-", "×", "÷"];
    private $oldResult = [];


    /**
     * Get the value of num1
     */
    public function getNum1()
    {
        return $this->num1;
    }

    /**
     * Set the value of num1
     *
     * @return  self
     */
    public function setNum1($num1)
    {
        $this->num1 = $num1;

        return $this;
    }

    /**
     * Get the value of num2
     */
    public function getNum2()
    {
        return $this->num2;
    }

    /**
     * Set the value of num2
     *
     * @return  self
     */
    public function setNum2($num2)
    {
        $this->num2 = $num2;

        return $this;
    }

    /**
     * Get the value of select
     */
    public function getSelect()
    {
        return $this->select;
    }

    /**
     * Set the value of select
     *
     * @return  self
     */
    public function setSelect($select)
    {
        $this->select = $select;

        return $this;
    }

    /**
     * Get the value of msg
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * Set the value of msg
     *
     * @return  self
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;

        return $this;
    }

    /**
     * Get the value of result
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set the value of result
     *
     * @return  self
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get the value of selected
     */
    public function getSelected()
    {
        return $this->selected;
    }

    /**
     * Set the value of selected
     *
     * @return  self
     */
    public function setSelected($selected)
    {
        $this->selected = $selected;

        return $this;
    }

    /**
     * Get the value of oldResult
     */
    public function getOldResult()
    {
        return $this->oldResult;
    }

    /**
     * Set the value of oldResult
     *
     * @return  self
     */
    public function setOldResult($oldResult)
    {
        $this->oldResult = $oldResult;

        return $this;
    }
}
