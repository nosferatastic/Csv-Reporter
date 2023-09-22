<?php

abstract class CsvParser
{
    // Values to hold the data store for the output, and the file resource stream
    protected $dataStore;
    protected $csvFile;

    // Abstract functions will implement verification for row format/type, 
    // and preparation/processing of row into data store
    abstract public function verifyRow(array $row): bool;
    abstract public function prepareRow(array $row): array;
    abstract public function processRow(array $row): bool;

    // Implemented functions below

    /*
     * Load the procided file resource stream into the class
     * @param String $fileName : Filename/location of CSV file
     */
    public function loadCsv($fileName)
    {   
        //Open the file and return the parser if it is successful
        $this->csvFile = fopen($fileName, "r") or die("Could not find file");
        if($this->csvFile) {
            return $this;
        }
        return false;
    }

    /*
     * Read the data stream provided in the above function 
     * and write it into the data store
     * @return bool : True if successful, false if issues
     */ 
    public function readCsvToStore(): bool {
        if(!$this->csvFile) {
            return false;
        }
        
        while (! feof($this->csvFile)) {
            $row = fgetcsv($this->csvFile, 0, ",");
            if(!empty($row)) {
                $row = $this->prepareRow($row);
                if(!$this->verifyRow($row)) {
                    return false;
                }
                $this->processRow($row);
            }
        }
        return true;
    }

    /*
     * Close the data stream within this class.
     * @return bool : True if successful (or if it doesn't exist), false if issues
     */ 
    public function closeCsv(): bool {
        try {
            if($this->csvFile) {
                fclose($this->csvFile);
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /*
     * Retrieve the data store object.
     */ 
    public function getDataStore() {
        return $this->dataStore;
    }
    
}