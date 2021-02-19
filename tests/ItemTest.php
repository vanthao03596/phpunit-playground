<?php

namespace Tests;

use App\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    protected Item $itemTest;

    protected function setUp(): void
    {
        parent::setUp();

        $this->itemTest = Item::make()
            ->withWidth(1)
            ->withHeight(2)
            ->withWeight(3)
            ->withDepth(4)
            ->withAmazonPrice(50);
    }

    public static function callMethod($obj, $name, array $args)
    {
        $class = new \ReflectionClass($obj);
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method->invokeArgs($obj, $args);
    }

    public function testWithAmazonPrice()
    {
        $item = Item::make();

        $item->withAmazonPrice(1);

        $this->assertEquals(1, $item->getAmazonPrice());
    }

    public function testWithWeight()
    {
        $item = Item::make();

        $item->withWeight(1);

        $this->assertEquals(1, $item->getWeight());
    }

    public function testWithDepth()
    {
        $item = Item::make();

        $item->withDepth(1);

        $this->assertEquals(1, $item->getDepth());
    }

    public function testWithWeightCoefficient()
    {
        $item = Item::make();

        $this->assertEquals(DEFAULT_WEIGHT_COEFFICIENT, $item->getWeightCoefficient());

        $item->withWeightCoefficient(1);

        $this->assertEquals(1, $item->getWeightCoefficient());
    }

    public function testWithDimensionCoefficient()
    {
        $item = Item::make();

        $this->assertEquals(DEFAULT_DIMENSION_COEFFICIENT, $item->getDimensionCoefficient());

        $item->withDimensionCoefficient(1);

        $this->assertEquals(1, $item->getDimensionCoefficient());
    }

    public function testWithHeight()
    {
        $item = Item::make();

        $item->withHeight(1);

        $this->assertEquals(1, $item->getHeight());
    }

    public function testWithWidth()
    {
        $item = Item::make();

        $item->withWidth(1);

        $this->assertEquals(1, $item->getWidth());
    }

    public function testMake()
    {
        $item = Item::make();

        $this->assertInstanceOf(Item::class, $item);
    }

    public function testFeeByDimensions()
    {
        $expected = $this->itemTest->getWidth() * $this->itemTest->getHeight() * $this->itemTest->getDepth() * $this->itemTest->getDimensionCoefficient();

        $feeByDimensions = static::callMethod(
            $this->itemTest,
            'feeByDimensions',
            []
        );

        $this->assertEquals($expected, $feeByDimensions);
    }

    public function testFeeByWeight()
    {
        $feeByWeight = static::callMethod(
            $this->itemTest,
            'feeByWeight',
            []
        );

        $expected = $this->itemTest->getWeight() * $this->itemTest->getWeightCoefficient();

        $this->assertEquals($expected, $feeByWeight);
    }

    public function testShippingFee()
    {
        $shippingFee = static::callMethod(
            $this->itemTest,
            'shippingFee',
            []
        );

        $this->assertEquals(88, $shippingFee);

        $this->itemTest->withFeeByProductType(100);

        $shippingFeeByProductType = static::callMethod(
            $this->itemTest,
            'shippingFee',
            []
        );

        $this->assertEquals(100, $shippingFeeByProductType);
    }

    public function testItemPrice()
    {
        $shippingFee = static::callMethod(
            $this->itemTest,
            'shippingFee',
            []
        );

        $expected = $shippingFee + $this->itemTest->getAmazonPrice();

        $this->assertEquals($expected, $this->itemTest->itemPrice());
    }


}
