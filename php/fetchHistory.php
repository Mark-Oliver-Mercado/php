<?php
include('connect.php');

if (isset($_GET['department'])) {
    $department = $_GET['department'];

    // Sanitize input to prevent SQL injection
    $department = mysqli_real_escape_string($conn, $department);

    // Fetch attendance records for the selected department
    $query = "SELECT * FROM attendancelist WHERE department = '$department'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $employee) {
            echo "<tr>
                    <td style='font-size: 0.875em;'>{$employee['user_id']}</td>
                    <td style='font-size: 0.875em;'>{$employee['em_id']}</td>
                    <td style='font-size: 0.875em;'>{$employee['em_fullname']}</td>
                    <td style='font-size: 0.875em;'>{$employee['department']}</td>
                    <td style='font-size: 0.875em;'>{$employee['em_date']}</td>
                    <td style='font-size: 0.875em;'>" . date('H:i', strtotime($employee['morning_timein'])) . "</td>
                    <td style='font-size: 0.875em;'>" . date('H:i', strtotime($employee['morning_timeout'])) . "</td>
                    <td style='font-size: 0.875em;'>{$employee['break']}</td>
                    <td style='font-size: 0.875em;'>" . date('H:i', strtotime($employee['afternoon_timein'])) . "</td>
                    <td style='font-size: 0.875em;'>" . date('H:i', strtotime($employee['afternoon_timeout'])) . "</td>
                    <td style='font-size: 0.875em;'>{$employee['status']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='11' class='text-center'>No Record Found</td></tr>";
    }
} else {
    echo "<tr><td colspan='11' class='text-center'>Invalid Request</td></tr>";
}
