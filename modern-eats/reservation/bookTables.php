<?php
include '../includes/dbConnect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$id = $_SESSION['user_id'];

// Validate POST data
$name = $_POST['name'] ?? null;
$phone = $_POST['phone'] ?? null;
$date = $_POST['date'] ?? null;
$time = $_POST['time'] ?? null;
$people = $_POST['people'] ?? null;

if (!$name || !$phone || !$date || !$time || !$people) {
    die("Missing required fields.");
}

// Check if the user already has a reservation at the given time
$stmt = $mysqli->prepare("SELECT * FROM reservation_tables WHERE cust_id = ? AND reservation_time = ?");
if (!$stmt) {
    die("Prepare failed: " . $mysqli->error);
}
$stmt->bind_param("is", $id, $time);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) { // Correct check for existing reservation

    // Insert into reservations table
    $stmt = $mysqli->prepare("INSERT INTO reservations (customer_name, cust_contact, reservation_date, reservation_time, number_of_people, cust_id)
                              VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $mysqli->error);
    }
    $stmt->bind_param("ssssii", $name, $phone, $date, $time, $people, $id);

    if (!$stmt->execute()) {
        die("Error inserting reservation: " . $stmt->error);
    }

  
} else {
    echo "You already have a reservation at this time.";
}

$stmt->close();
?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book a Table</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../styles/booking.css">
  <?php 
        include "../includes/bootstrapcdn.php";
        ?>
  <style>
    .tables {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
    }

    .sec {

      background-color: rgba(255, 255, 255, 0.9);
      border: 2px solid white;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      padding: 10px;
      transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out, color 0.3s ease-in-out;
    }

    .sec:hover {
      transform: scale(1.1);
      /* Increase size */
      background-color: #f0f0f0;
      /* Change background color */
      color: #333;
      /* Change text color */
    }

    .disabled {
      background-color: #ccc !important;
      color: #666 !important;
      pointer-events: none;
    }
  </style>

</head>

<body>

  <header>
  <?php 
        include "../includes/navbar.php";
        ?>
  </header>


  <main class="main-container">
    <section class="form-container">
      <img src="../images/2.jpg" alt="table" width="100%">
      <form action="save_selected_tables.php" method="POST">
        <input type="hidden" name="date" value="<?php echo $date; ?>">
        <input type="hidden" name="time" value="<?php echo $time; ?>">
        <input type="hidden" id="selectedTables" name="tables"> <!-- Stores selected tables -->

        <div class="tables"></div>
         <br>
        <button type="submit">Confirm Reservation</button>
      </form>


    </section>
  </main>




</body>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const selectedDate = "<?php echo $date; ?>";
    const selectedTime = "<?php echo $time; ?>";

    if (!selectedDate || !selectedTime) {
      alert("Date and Time are required!");
      window.location.href = "http://localhost/modern-eats/reservation/booking.php";
      return;
    }

    const tab = document.querySelector(".tables");
    const selectedTables = new Set();
    const hiddenInput = document.getElementById("selectedTables"); // Hidden input field

    async function fetchReservedTables() {
      try {
        const response = await fetch("fetch_reserved_tables.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify({
            date: selectedDate,
            time: selectedTime
          }),
        });

        if (!response.ok) throw new Error("Failed to fetch reserved tables");

        return await response.json();
      } catch (error) {
        console.error("Error:", error);
        return [];
      }
    }

    async function renderTables() {
      const reservedTables = await fetchReservedTables();

      for (let index = 1; index <= 17; index++) {
        const div = document.createElement("div");
        div.className = "sec";
        div.textContent = `Table ${index}`;
        div.dataset.tableId = index;

        if (reservedTables.includes(index)) {
          div.classList.add("disabled");
          div.style.pointerEvents = "none";
          div.style.opacity = "0.5";
        }

        tab.appendChild(div);
      }
    }

    renderTables();

    tab.addEventListener("click", function(event) {
      const clickedDiv = event.target;

      if (clickedDiv.classList.contains("sec") && !clickedDiv.classList.contains("disabled")) {
        const tableId = clickedDiv.dataset.tableId;

        if (selectedTables.has(tableId)) {
          selectedTables.delete(tableId);
          clickedDiv.style.backgroundColor = "";
          clickedDiv.style.color = "";
        } else {
          selectedTables.add(tableId);
          clickedDiv.style.backgroundColor = "#ff5733";
          clickedDiv.style.color = "white";
        }

        hiddenInput.value = Array.from(selectedTables).join(",");
      }
    });
  });
</script>

</html>