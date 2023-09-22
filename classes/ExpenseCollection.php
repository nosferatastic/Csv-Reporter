<?php

include "./classes/Expense.php";

/*
 * This class holds Expense objects in its array store
 * and can be used to retrieve totals.
 * For the tech task, I built two versions of this class 
 * - this one is less efficient but more fun in its 
 * execution as we calculate the totals by category when 
 * they are requested.
 */
class ExpenseCollection {

    protected array $expenses = [];
    // The below stores the expense categories accounted for in this collection.
    // As a note, it would be more efficient if I were to make an associative 
    // array of format "Category Type => Sum Total Cost" and update as elements are added. 
    // But it would be less fun to calculate!
    protected array $expenseTypes = [];

    /*
     * Adds an Expense object to the expense/expense type stores within this collection.
     * @param Expense $expense : Expense object to be added.
     */
    public function addExpense(Expense $expense): ExpenseCollection
    {
        array_push($this->expenses, $expense);
        //If we don't have this category stored, push it.
        if(!in_array($expense->getCategory(), $this->getExpenseTypes())) {
            array_push($this->expenseTypes, $expense->getCategory());
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
     * Retrieves the array containing the Expense objects for this ExpenseCollection
     * @param string $category : The name of the category we are trying to retrieve expenses for
     */
    private function getExpensesByCategory(string $category): array
    {
        //Save some processing power, if we know we don't have any we can just return none
        if(!in_array($category, $this->getExpenseTypes())) {
            return array();
        }
        //If we do have some, let's filter the expenses array and return the valid ones.
        return array_filter(
            $this->getExpenses(), 
            (fn (Expense $expense) => $expense->getCategory() == $category)
        );
    }

    /*
     * Gets the total sum of expenses accumulated for a specified category within this ExpenseCollection
     * @param string $category : The name of the category we are trying to retrieve expenses for
     */
    private function getExpenseTotalByCategory(string $category): float
    {
        //Retrieve matching expenses
        $theseExpenses = $this->getExpensesByCategory($category);
        $total = 0;
        foreach($theseExpenses as $expense) {
            //Sum total cost (note: getTotalCost function performs price*amount calculation)
            $total += $expense->getTotalCost();
        }
        return $total;
    }

    /*
     * Retrieves an array containing the category name and total expenses cost within this ExpenseCollection
     * for the specified category.
     */
    public function getExpenseTotals(): array
    {
        $totals = array();
        foreach($this->getExpenseTypes() as $category) {
            $totals[$category] = $this->getExpenseTotalByCategory($category);
        }
        return $totals;
    }
}