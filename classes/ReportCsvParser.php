<?php

include "./classes/abstract/CsvParser.php";

include "./classes/ExpenseCollection.php";
//Replace the above with the below line to use the alternative ExpenseCollection class.
//include $_SERVER['DOCUMENT_ROOT']."/classes/ExpenseCollectionAlternative.php";

class ReportCsvParser extends CsvParser
{
    /*
     * Create the ReportCsvParser object.
     * To make things easier we also pull in the filename and load the CSV.
     * @param String $fileName : Filename/location of CSV resource.
     */
    function __construct($fileName) {
        $this->dataStore = new ExpenseCollection();
        $this->loadCsv($fileName);
    }

    /*
     * Verify row of CSV matches required format
     * @param array $row : The row from the CSV, with each column as element of array.
     */
    public function verifyRow(array $row): bool
    {
        //Performing some basic verification on the integrity of the data.
        //Row 1 must be string (category). 2 & 3 must be numeric
        if(count($row) != 3 
        || !is_string($row[0]) 
        || !is_numeric($row[1]) 
        || !is_numeric($row[2])
    ) {
        return false;
    }
    return true;
    }


    /*
     * Prepare row for processing/storage. Anything that needs to be done before it can be verified.
     * Returns the modified/prepared row.
     * @param array $row : The row from the CSV, with each column as element of array.
     */
    public function prepareRow(array $row): array
    {
        // Trim each entry - remove leading/trailing spaces
        // for processing purposes in case of data entry quirks 
        // (as we state we will do on the site)
        return array_map(
            'trim',
            $row
        );
    }

    /*
     * Process row and put it in the data store, in this case it is an ExpenseCollection so we make an Expense.
     * @param array $row : The prepared row from the CSV, with each column as element of array.
     */
    public function processRow($row): bool {
        $expense = new Expense($row);
        $this->dataStore->addExpense($expense);
        return true;
    }
}