<?php

include "./classes/Expense.php";

/*
 * This class holds Expense objects in its array store
 * and can be used to retrieve totals.
 * For the tech task, I built two versions of this class 
 * - this one is more efficient for data retrieval as we
 * store totals as we go. But it's less fun as there is no
 * calculation required at the point of retrieval for totals.
 */
class ExpenseCollection {

    protected array $expenses = [];
    // An associative array of format "Category Type => Sum Total Cost" 
    // which is updated as elements are added.
    protected array $expenseTypes = [];

    /*
     * Adds an Expense object to the expense/expense type stores within this collection.
     * @param Expense $expense : Expense object to be added.
     */
    public function addExpense(Expense $expense): ExpenseCollection
    {
        array_push($this->expenses, $expense);
        //If we don't have this category stored, we initialise it with total from this expense.
        if(!in_array($expense->getCategory(), array_keys($this->expenseTypes))) {
            $this->expenseTypes[$expense->getCategory()] = $expense->getTotalCost();
        } else {
            //If we do, we add the total cost to the existing total stored.
            $this->expenseTypes[$expense->getCategory()] += $expense->getTotalCost();
        }
        return $this;
    }

    /*
     * Retrieves the array containing the Expense objects for this ExpenseCollections
     */
    private function getExpenses(): array
    {
        return $this->expenses;
    }

    /*
     * Retrieves the array containing the Expense types (& totals) for this ExpenseCollections
     */
    private function getExpenseTypes(): array
    {
        return $this->expenseTypes;
    }

    /*
     * Retrieves an array containing the category name and total expenses cost within this ExpenseCollection
     * for the specified category.
     */
    public function getExpenseTotals(): array
    {
        //In this alternative scenario things are much easier. We can just return the expense types array
        return $this->getExpenseTypes();
    }
}