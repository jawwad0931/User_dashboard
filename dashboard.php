<?php
session_start();
include 'config.php'; // Connection to the database

if (!isset($_SESSION['auth_user'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}


// yahan per jo hum id ka use kar rahay hain wo foreign key
//  hai jesay ke user_profile walay table mai jo foreign key
//  use ho rahi hai humne id uska daala hai mere case mai user_id hai
$user_id = $_SESSION['auth_user']['id'];
// Retrieve user profile information
$query = "SELECT * FROM user_profile WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);
$user_profile = mysqli_fetch_assoc($result);

if (!$user_profile) {
    echo "No profile found for the user.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>

<body>
    <button >Fill your input data</button>
    <h1>Welcome,
        <?php echo $_SESSION['auth_user']['email']; ?>!
    </h1>

    <!--for practice purposes Display user profile information -->
    <h2>User Profile:</h2>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Address</th>
            <th>Runs</th>
            <!-- Add more column headers for additional profile fields -->
        </tr>
        <?php if ($user_profile): ?>
            <tr>
                <td>
                    <?php echo $user_profile['name']; ?>
                </td>
                <td>
                    <?php echo $user_profile['age']; ?>
                </td>
                <td>
                    <?php echo $user_profile['address']; ?>
                </td>
                <td>
                    <?php echo $user_profile['Run']; ?>
                </td>
                <!-- Add more table cells for additional profile fields -->
            </tr>
        <?php else: ?>
            <tr>
                <td colspan="3">No profile found.</td>
            </tr>
        <?php endif; ?>
    </table>

</body>

</html>