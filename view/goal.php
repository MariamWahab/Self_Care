<?php
include('../settings/connection.php');
session_start(); // Start the session

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$user_id = 1; // Assuming the user ID is known for this example
$sql = "SELECT GoalID, GoalText, GoalStatus, ReminderTime FROM goals WHERE UserID = ?";
$stmt = $connection->prepare($sql);
if (!$stmt) {
    die("Error preparing statement: " . $connection->error);
}
$stmt->bind_param("i", $user_id);
if (!$stmt->execute()) {
    die("Error executing statement: " . $stmt->error);
}
$result = $stmt->get_result();

// Store the fetched goals in an array
$goals = [];
while ($row = $result->fetch_assoc()) {
  // Check if ReminderTime is not null before formatting
  if ($row['ReminderTime'] !== null) {
      $row['ReminderTime'] = date("h:i A", strtotime($row['ReminderTime'])); // Format reminder time
  }
  $goals[] = $row;

} 
$stmt->close();

$connection->close();

// Check if there's a deletion message in the session
if (isset($_SESSION['delete_message'])) {
    $delete_message = $_SESSION['delete_message'];
    unset($_SESSION['delete_message']); // Clear the session variable
} else {
    $delete_message = ""; // Initialize an empty message if no message is set
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Goals</title>
  <link rel="stylesheet" href="../css/goal.css">
  <link rel="stylesheet" href="../css/nav-bar.css">

  <!-- Include Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <header>
    <div class="nav-bar">
      <div class="nav-bar-title">
        SelfCare Goals 
      </div>
      
      <nav>
        <ul >
          <li class="<?php echo ($message === 'home' || $message === '') ? 'active' : '';?>"><a href="homePage.php">Home</a></li>
          <li class="<?php echo ($message === 'skinCare' || $message === '') ? 'active' : '';?>"><a href="skinCare.php?msg=skin_Care">Skin Care Corner</a></li>
          <li class="<?php echo ($message === 'exercise' || $message === '') ? 'active' : '';?>"><a href="exercise.php?msg=exercise">Exerices</a></li>
          <li class="<?php echo ($message === 'wellnessTips' || $message === '') ? 'active' : '';?>"><a href="wellness.php?msg=wellnessTips">Wellness Tips</a></li>
          <li class="<?php echo ($message === 'community' || $message === '') ? 'active' : '';?>"><a href="community.php?msg=interactiveCommunity">Community </a></li>
          <li class="<?php echo ($message === 'profile' || $message === '') ? 'active' : '';?>"><a href="profile.php?msg=profile">Profile </a></li>
        </ul>
      </nav>
    </div>
  </header>
  <main>
    <section class="wellness-plans">
      <h2>Self Care Goals</h2>


      <?php
      // Display deletion message if available
      if (!empty($delete_message)) {
          echo "<p>" . htmlspecialchars($delete_message) . "</p>";
      }
      ?>
      <form method="post" action="../action/add_goal.php">
        <label for="goal">Set Your Goal:</label>
        <input type="text" id="goal" name="goal" placeholder="Enter your goal...">
        <label for="reminder">Set Reminder Time:</label>
        <input type="time" id="reminder" name="reminder">
        <button type="submit">Set Goal</button>
      </form>
      <table id="goals-table">
        <thead>
          <tr>
            <th>Goal</th>
            <th>Status</th>
            <th>Reminder</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if (isset($goals) && !empty($goals)) {
              foreach ($goals as $goal) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($goal['GoalText']) . "</td>"; // Display goal text
                echo "<td>";
                echo "<form method='post' action='../action/update_goal_status.php'> ";
                echo "<input type='hidden' name='goal_id' value='" . $goal['GoalID'] . "'>";
                echo "<select name='goal_status'>";
                echo "<option value='complete'" . ($goal['GoalStatus'] === 'complete' ? ' selected' : '') . ">Completed</option>";
                echo "<option value='incomplete'" . ($goal['GoalStatus'] === 'incomplete' ? ' selected' : '') . ">Incomplete</option>";
                echo "</select>";
                echo "<button type='submit' name='update_status' id='update'>Ok</button>";
                echo "</form>";
                echo "</td>";
                echo "<td>" . ($goal['ReminderTime'] !== null ? htmlspecialchars($goal['ReminderTime']) : "") . "</td>"; // Display reminder time if not null
                echo "<td>";
                echo "<form method='post' action='../action/update_goal.php'>";
                echo "<input type='hidden' name='goal_id' value='" . $goal['GoalID'] . "'>";
                echo "<button type='submit' name='edit'>Edit</button>";
                echo "</form>";
                echo "<form method='post' action='../action/delete_goal.php'>";
                echo "<input type='hidden' name='goal_id' value='" . $goal['GoalID'] . "'>";
                echo "<button type='submit' name='delete'>Delete</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
              
              }
            } else {
              echo "<tr><td colspan='4'>No goals found</td></tr>";
            }
          ?>
        </tbody>
      </table>
    </section>
  </main>
  
  <footer>
    <p>&copy; 2024 Personalized Wellness. All rights reserved.</p>
  </footer>
  
  <!-- JavaScript to show footer when user reaches end of page -->
  <script>
    window.addEventListener('scroll', function() {
        var scrollPosition = window.scrollY;
        var totalHeight = document.body.scrollHeight - window.innerHeight;

        // Show footer if scrolled to the bottom
        if (scrollPosition === totalHeight) {
            document.querySelector('footer').style.display = 'block';
        } else {
            document.querySelector('footer').style.display = 'none';
        }
    });

    function confirmEdit() {
        return confirm("Are you sure you want to edit this goal?");
    }
  </script>
</body>
</html>
