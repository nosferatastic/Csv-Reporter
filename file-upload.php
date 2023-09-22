<!-- Stylesheet should be broken into another file if it becomes significant -->

<form enctype="multipart/form-data" action="<?php echo("/report");?>" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="16777216" />
    <div class="border-box">
    <header>
        <h3>Select a new CSV file:</h3>
    </header>
    <input name="userfile" type="file" accept=".csv" />
    <input type="submit" value="Upload File" />
    <br/>
    <br/>
    <hr/>
    <p>
        <i><strong>Please Note:</strong></i> 
        The CSV upload must match the required format:
        <ul>
            <li>Must not have any headers.</li>
            <li>Three columns per row, comma-separated.</li>
            <li>The three columns, in order, represent Category, Price, & Amount.</li>
            <li>
                The data in these columns must be of the correct type ie. in order, String, Numeric, & Numeric.
                <br/>
                <i>If there are leading or trailing spaces in the columns, they will be removed for processing purposes.</i>
            </li>
        </ul>
    </p>
    </div>
</form>