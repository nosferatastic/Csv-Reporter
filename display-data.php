<!-- Link to stylesheet -->
<link rel="stylesheet" href="./css/style.css">

<!-- Main Content -->
<header><h2>Expense Report</h2></header>

<?php
//We only show totals table if totals exist (ie. file is imported)
if(isset($totals)) {
?>  
    <!-- Export Report/Table -->
    <div class="report-container scroll-shadows">
        <table>
            <col>
            <col style="min-width:10%; max-width:50%;">
            <thead>
                <tr>
                    <th>Category</th>
                    <th class="number-col">Total Cost</th>
                </tr>
            </thead>
            <?php 
            foreach($totals as $category => $total) {
            ?>
                <tr>
                    <td>
                        <?php echo(htmlspecialchars($category));?>
                    </td>
                    <td class="number-col">
                        <?php echo(htmlspecialchars($total));?>
                    </td>
                </tr>
            <?php 
            }
            ?>
        </table>
    </div>
    <div style="height:25px;"></div>
    <!-- Report/Table Export -->
    <div class="border-box">
        <header>
            <h3>Download this report as CSV:</h3>
        </header>
        <form action="<?php echo("/export"); ?>" method="post">
            <input type="hidden" name="data" value="<?php echo(htmlspecialchars(json_encode($totals))); ?>" />
            <input type="submit" value="Download CSV" target="_blank" class="button">
        </form>
    </div>
<?php
} elseif(isset($error)) {
?>
    <p class="error"><i><?php echo($error); ?></i></p>
<?php
} else {
?>
    <p><i>No file selected. Please upload one below.</i></p>
<?php
}
?>
<div style="height:25px;"></div>

<!-- File Upload -->
<?php include("./file-upload.php"); ?>