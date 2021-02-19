<?php

namespace App;

class Order
{
    /**
     * @var Item[]
     */
    protected $items = [];

    public function addItem(Item $item)
    {
        $this->items[] = $item;

        return $this;
    }

    public function calculateGrossPrice()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->itemPrice();
        }
        return $total;
    }

    public static function make()
    {
        return new static();
    }

    public function getItems()
    {
        return $this->items;
    }
}


