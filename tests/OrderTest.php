<?php

namespace Tests;

use App\Item;
use App\Order;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    protected Item $itemTest1;
    protected Item $itemTest2;

    protected function setUp(): void
    {
        parent::setUp();

        $this->itemTest1 = Item::make()
            ->withWidth(1)
            ->withHeight(2)
            ->withWeight(3)
            ->withDepth(4)
            ->withAmazonPrice(50);

        $this->itemTest2 = Item::make()
            ->withWidth(1)
            ->withHeight(2)
            ->withWeight(3)
            ->withDepth(4)
            ->withAmazonPrice(60);
    }

    public function testAddItem()
    {
        $order = Order::make()
            ->addItem($this->itemTest1)
            ->addItem($this->itemTest2);

        $this->assertCount(2, $order->getItems());

        $this->assertInstanceOf(Item::class, $order->getItems()[0]);
    }

    public function testCalculateGrossPrice()
    {
        $order = Order::make()
            ->addItem($this->itemTest1)
            ->addItem($this->itemTest2);

        $expected = $this->itemTest1->itemPrice() + $this->itemTest2->itemPrice();

        $this->assertEquals($expected, $order->calculateGrossPrice());
    }

    public function testMake()
    {
        $order = Order::make();

        $this->assertInstanceOf(Order::class, $order);
    }
}
