<?php
//Including Database configuration file.
include "db.php";
//Getting value of "search" variable from "scripts.js".
if (isset($_POST['search'])) {
//Search box value assigning to $Name variable.
    $Name = $_POST['search'];
//Search query.
    $Query = "SELECT Name FROM search WHERE Name LIKE '%$Name%' LIMIT 5";
//Query execution
    $ExecQuery = MySQLi_query($con, $Query);

    if (!$ExecQuery) {
        printf("Error: %s\n", mysqli_error($con));
        exit();
    }
//Creating unordered list to display result.
    echo '
<ul>
   ';
    //Fetching result from database.
    while ($Result = MySQLi_fetch_array($ExecQuery)) {
        ?>
        <!-- Creating unordered list items.
             Calling javascript function named as "fill" found in "scripts.js" file.
             By passing fetched result as parameter. -->
        <li onclick='fill("<?php echo $Result['Name']; ?>")'>
            <a>
                <!-- Assigning searched result in "Search box" in "search.php" file. -->
                <?php echo $Result['Name']; ?>
        </li></a>
        <!-- Below php code is just for closing parenthesis. Don't be confused. -->
        <?php
    }}
?>
</ul>
