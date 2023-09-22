<?php

class Expense {
    protected string $category;
    protected float $costPerItem;
    protected int $itemCount;

    /*
     * Constructs Expense.
     * @param array $csvLine : A line from the imported CSV represented as array. Format [ category, price, amount].
     */
    function __construct(array $csvLine) 
    {
        [$this->category, $this->costPerItem, $this->itemCount] = $csvLine;
    }

    /*
     *  Retrieves the total cost for this line-item.
     */ 
    public function getTotalCost(): float
    {
        return $this->costPerItem * $this->itemCount;
    }

    /*
     * Retrieves the category name (string) for this line-item.
     */
    public function getCategory(): string
    {
        return $this->category;
    }
}