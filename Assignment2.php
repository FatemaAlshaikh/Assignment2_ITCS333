<?php
// Define the URL for the API request that retrieves student statistics data
$url = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Fetch the contents of the URL and store it in the $response variable
$response = file_get_contents($url);

// Decode the JSON response into an associative array
$data = json_decode($response, true);

// Check if the data is valid and contains the "results" key
if(!$data || !isset($data["results"])){
    // If data is invalid or missing the results, stop execution and display an error message
    die('error fetching the data from API');
}

// Store the results from the API response in a variable
$result = $data["results"];
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- External Pico CSS framework link -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">

        <!-- Internal CSS to style the table and page -->
        <style>
                body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f9;
                margin: 0;
                padding: 20px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            th, td {
                padding: 10px;
                text-align: center;
                border: 1px solid #ddd;
            }

            th {
                background-color:#9adae6; 
                color: white;
            }
            h1 {
                text-align: center;
                color: #333;
                margin-bottom: 20px;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>University of Bahrain Students Enrollment by Nationality</h1>
            <!-- Create a table to display the student statistics -->
            <table>
                <thead>
                    <tr>
                        <!-- Define table headers -->
                        <th>Year</th>
                        <th>Semester</th>
                        <th>The programs</th>
                        <th>Nationality</th>
                        <th>Colleges</th>
                        <th>Number Of Students</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Loop through each record in the API response and display it in a table row
                foreach($result as $student) {
                    ?>
                    <tr>
                        <!-- Output each field from the student record into a table cell -->
                        <td><?php echo $student["year"]; ?></td>
                        <td><?php echo $student["semester"]; ?></td>
                        <td><?php echo $student["the_programs"]; ?></td>
                        <td><?php echo $student["nationality"]; ?></td>
                        <td><?php echo $student["colleges"]; ?></td>
                        <td><?php echo $student["number_of_students"]; ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
