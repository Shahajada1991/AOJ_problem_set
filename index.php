<?php
$problem_id = "";  // Initialize problem_id
$cluster = "Please provide a problem ID.";  // Default message

// Check if the 'problem_id' is passed through the URL
if (isset($_GET['problem_id'])) {
    $problem_id = $_GET['problem_id'];  // Get the problem_id from the URL
    $file = fopen('Cluster Data.csv', 'r');  // Open the CSV file for reading
    $found = false;  // Flag to check if problem_id is found

    // Read the CSV file line by line
    while (($row = fgetcsv($file)) !== FALSE) {
        // If the problem_id matches, set the cluster
        if ($row[0] == $problem_id) {
            $cluster = $row[1];  // Get the corresponding cluster
            $found = true;
            break;
        }
    }

    // If no matching problem_id is found, set the message accordingly
    if (!$found) {
        $cluster = "No cluster found for this problem ID.";
    }

    fclose($file);  // Close the CSV file
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problem Cluster</title>
</head>
<body>
    <h1>Problem Difficulty Information</h1>

    <!-- Form to enter problem_id -->
    <form method="GET" action="">
        <label for="problem_id">Enter Problem ID:</label>
        <input type="text" id="problem_id" name="problem_id" value="<?php echo htmlspecialchars($problem_id); ?>" required>
        <input type="submit" value="Get Cluster">
    </form>

    <div>
        <!-- Show the problem_id and corresponding cluster -->
        <h2>Problem ID: <?php echo htmlspecialchars($problem_id); ?></h2>
        <h3>Cluster: <?php echo htmlspecialchars($cluster); ?></h3>
    </div>
</body>
</html>
