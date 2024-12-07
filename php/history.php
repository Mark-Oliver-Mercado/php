<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Database connection
include '../php/config.php';

// Fetch the user's profile image
$user_id = $_SESSION['id'];
$query = "SELECT profile_image FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($profileImagePath);
$stmt->fetch();
$stmt->close();

// Set a default image if no profile picture is set
$profileImagePath = $profileImagePath ? '../uploads/' . $profileImagePath : 'default-profile.png';

// Retrieve the theme color from session
$theme_color = isset($_SESSION['theme_color']) ? $_SESSION['theme_color'] : 'blue'; // Default to blue if no theme is set
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/history.css">
    <!-- Dynamically link the CSS for the selected theme -->
    <link rel="stylesheet" href="../css/<?php echo ($theme_color == 'blue') ? 'blue' : 'pink'; ?>.css">
</head>

<body>
    <header>
        <h2>Welcome to Your Dashboard, <?php echo $_SESSION['username']; ?>!</h2>
        <!-- Add the dynamic background image directly to the logout button -->
        <a href="javascript:void(0)" class="logout" onclick="toggleDropdown()" style="background-image: url('<?php echo $profileImagePath; ?>');"></a>

        <div class="logo">
            <a href="#" class="d-flex ">
                <img src="../images/logo eels.png" alt="Logo" id="logo">
            </a>
        </div>

        <div id="dropdown" class="dropdown-content">
            <a href="../php/dashboard.php">Home</a>
            <a href="../php/profile.php">Profile</a>
            <a href="../php/settings.php">Settings</a>
            <a href="../php/logout.php">Logout</a>
        </div>
    </header>

    <!-- Attendance Table List -->
    <section class="container">
        <div class="row">
            <div class="">
                <div class="card">
                    <div class="card-header d-flex justify-content-center align-items-center">
                        <!-- Print Icon Button -->
                        <button id="print-btn" class="print-button">
                            <span class="material-symbols-outlined"> Print </span>
                        </button>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th class="equal-width" style="font-size: 0.875em; text-align: center; vertical-align: middle;" scope="col">Lesson</th>
                                    <th class="equal-width" style="font-size: 0.875em; text-align: center; vertical-align: middle;" scope="col">Date</th>
                                    <th class="equal-width" style="font-size: 0.875em; text-align: center; vertical-align: middle;" scope="col">Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $username = $_SESSION['username']; // Get the username from the session
                                $query = "SELECT * FROM scorelist WHERE username = ?";
                                $stmt = $conn->prepare($query);
                                $stmt->bind_param("s", $username);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    while ($record = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td style='font-size: 0.875em;'>" . htmlspecialchars($record['lesson']) . "</td>";
                                        echo "<td style='font-size: 0.875em;'>" . htmlspecialchars($record['date']) . "</td>";
                                        echo "<td style='font-size: 0.875em;'>" . htmlspecialchars($record['score']) . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='3' style='text-align:center;'>No Records Found</td></tr>";
                                }
                                $stmt->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        document.getElementById('print-btn').addEventListener('click', function() {
            // Create a new window
            const printWindow = window.open('', '', 'height=500,width=800');

            // Get the table's HTML
            const tableHTML = document.querySelector('.table').outerHTML;

            // Write the necessary HTML to the print window
            printWindow.document.write(`
            <html>
                <head>
                    <title>Print Attendance Record</title>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
                    <style>
                        body {
                            font-family: 'Poppins', sans-serif;
                        }
                        table {
                            width: 100%;
                            border-collapse: collapse;
                        }
                        th, td {
                            border: 1px solid #000;
                            padding: 8px;
                            text-align: center;
                        }
                        th {
                            background-color: #f2f2f2;
                        }
                    </style>
                </head>
                <body>
                    <h2 class="text-center">Employee's Attendance Record</h2>
                    ${tableHTML}
                </body>
            </html>
        `);

            // Close the document to trigger loading
            printWindow.document.close();

            // Wait for the new window to load and then call print
            printWindow.onload = function() {
                printWindow.print();
                printWindow.close();
            };
        });
    </script>

    <script>
        // Toggle the dropdown menu when the logout button is clicked
        function toggleDropdown() {
            var dropdown = document.getElementById("dropdown");
            dropdown.classList.toggle("show");
        }

        // Close the dropdown if the user clicks anywhere outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.logout') && !event.target.matches('.dropdown-content') && !event.target.matches('.dropdown-content a')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>

</html>