<?php
include('../settings/connection.php');
$user_id = 1; // Assuming the user ID is known for this example
$sql = "SELECT GoalID, GoalText, GoalStatus, ReminderTime FROM Goals WHERE UserID = ?";
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
    // Modify the goal text and reminder format as needed
    $row['ReminderTime'] = date("h:i A", strtotime($row['ReminderTime'])); // Format reminder time
    $goals[] = $row;
}
$stmt->close();

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personalized Wellness Plan</title>
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
      <h2>My Wellness Plan</h2>
      <form method="post" id="goal-form">
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
                echo "<select class='status-dropdown' data-goalid='" . $goal['GoalID'] . "'>";
                echo "<option value='complete'" . ($goal['GoalStatus'] === 'complete' ? ' selected' : '') . ">Completed</option>";
                echo "<option value='incomplete'" . ($goal['GoalStatus'] === 'incomplete' ? ' selected' : '') . ">Incomplete</option>";
                echo "</select>";
                echo "</td>";
                echo "<td>" . htmlspecialchars($goal['ReminderTime']) . "</td>"; // Display reminder time
                echo "<td>";
                echo "<button class='edit-btn' data-goalid='" . $goal['GoalID'] . "'>Edit</button>";
                echo "<button class='delete-btn' data-goalid='" . $goal['GoalID'] . "'>Delete</button>";
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

    <script>
          document.addEventListener('DOMContentLoaded', function() {
            // Event listener for editing goals
            document.querySelectorAll('.edit-btn').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    const goalId = event.target.dataset.goalid;
                    const newGoalText = prompt("Enter the new goal text:");
                    const newReminderTime = prompt("Enter the new reminder time (HH:MM AM/PM):");

                    if (newGoalText !== null && newReminderTime !== null) {
                        // Send a request to the server-side script to update the goal in the database
                        fetch('../action/update_goal.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                goal_id: goalId,
                                text: newGoalText,
                                reminder: newReminderTime,
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // If the update is successful, update the displayed goal
                                const goalRow = event.target.closest('tr');
                                goalRow.querySelector('td:nth-child(1)').textContent = data.new_goal_text;
                                goalRow.querySelector('td:nth-child(3)').textContent = data.new_reminder_time;
                                alert("Goal updated successfully.");
                            } else {
                                alert("Failed to update goal: " + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                    }
                });
            });

            // Event listener for deleting goals
            document.querySelectorAll('.delete-btn').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    const goalId = event.target.dataset.goalid;
                    const confirmation = confirm("Are you sure you want to delete this goal?");
                    
                    if (confirmation) {
                        fetch('../action/delete_goal.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                goal_id: goalId,
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                event.target.closest('tr').remove();
                                alert("Goal deleted successfully.");
                            } else {
                                alert("Failed to delete goal: " + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                    }
                });
            });

            // Event listener for updating goal status
            document.querySelectorAll('.status-dropdown').forEach(function(select) {
                select.addEventListener('change', function(event) {
                    const goalId = event.target.dataset.goalid; // Retrieve the goal ID
                    const status = event.target.value;

                    // Send AJAX request to update goal status
                    fetch('../action/update_goal_status.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({
                            goal_id: goalId,
                            status: status,
                        }).toString()
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Goal status updated successfully.");
                            location.reload(); // Reload the page after the status update
                        } else {
                            alert("Failed to update goal status: " + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            });

            // Event listener for adding goals
            document.getElementById('goal-form').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission behavior

                const formData = new FormData(this);

                fetch('../action/add_goal.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Goal added successfully, refresh the page
                        window.location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
          });
        </script><!-- Placeholder for charts/graphs -->
        
        </div>
    <!-- FILEPATH: /C:/xampp/htdocs/sample_group/Tranquility-Tribe-Team-Project/view/personalizedPlan.htm -->
    <!-- This section represents the end of a personalized plan in the Tranquility Tribe Team Project. -->
    </section>
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
  </script>
</body>
</html>
