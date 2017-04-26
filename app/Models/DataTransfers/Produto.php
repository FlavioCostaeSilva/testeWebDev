<?php

namespace App\Models\DataTransfers;


class Produto extends AbstractDataTransfer
{
    /** @var  $id int */
    protected $lm;

    /** @var  $name string */
    protected $name;

    /** @var  $category string */
    protected $category;

    /** @var  $free_shipping integer */
    protected $free_shipping;

    /** @var  $description string */
    protected $description;

    /** @var  $price float */
    protected $price;

    /**
     * @return int
     */
    public function getLm()
    {
        return $this->lm;
    }

    /**
     * @param int $lm
     * @return Produto
     */
    public function setLm($lm)
    {
        $this->lm = $lm;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Produto
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     * @return Produto
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return int
     */
    public function getFreeShipping()
    {
        return $this->free_shipping;
    }

    /**
     * @param int $free_shipping
     * @return Produto
     */
    public function setFreeShipping($free_shipping)
    {
        $this->free_shipping = $free_shipping;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Produto
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Produto
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
}