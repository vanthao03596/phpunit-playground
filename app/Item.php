<?php

namespace App;

class Item
{
    protected float $weight;
    protected float $width;
    protected float $height;
    protected float $depth;
    protected float $amazonPrice;
    protected float $weightCoefficient = DEFAULT_WEIGHT_COEFFICIENT;
    protected float $dimensionCoefficient = DEFAULT_DIMENSION_COEFFICIENT;
    protected $feeByProductType;


    public function itemPrice()
    {
        return $this->amazonPrice + $this->shippingFee();
    }

    protected function shippingFee()
    {
        if ($this->feeByProductType) {
            return max($this->feeByWeight(), $this->feeByDimensions(), $this->feeByProductType);
        }
        return max($this->feeByWeight(), $this->feeByDimensions());
    }

    protected function feeByWeight()
    {
        return $this->weight * $this->weightCoefficient;
    }

    protected function feeByDimensions()
    {
        return $this->width * $this->height * $this->depth * $this->dimensionCoefficient;
    }

    public function withWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    public function withHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    public function withWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    public function withDepth($depth)
    {
        $this->depth = $depth;

        return $this;
    }

    public function withAmazonPrice($amazonPrice)
    {
        $this->amazonPrice = $amazonPrice;

        return $this;
    }

    public function withWeightCoefficient($weightCoefficient)
    {
        $this->weightCoefficient = $weightCoefficient;

        return $this;
    }

    public function withDimensionCoefficient($dimensionCoefficient)
    {
        $this->dimensionCoefficient = $dimensionCoefficient;

        return $this;
    }

    public static function make()
    {
        return new static();
    }

    /**
     * @return float|int
     */
    public function getWeightCoefficient()
    {
        return $this->weightCoefficient;
    }

    /**
     * @return float|int
     */
    public function getDimensionCoefficient()
    {
        return $this->dimensionCoefficient;
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * @return float
     */
    public function getDepth(): float
    {
        return $this->depth;
    }

    /**
     * @return float
     */
    public function getAmazonPrice(): float
    {
        return $this->amazonPrice;
    }

    public function withFeeByProductType($feeByProductType)
    {
        $this->feeByProductType = $feeByProductType;

        return $this;
    }
}
