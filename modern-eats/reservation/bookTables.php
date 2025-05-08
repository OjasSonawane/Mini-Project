<?php
include '../includes/dbConnect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
  die("User not logged in.");
}

$_SESSION['reservationId'] = $_POST['postId'] ?? null;

// Validate POST data
$_SESSION['name'] = $_POST['name'] ?? null;
$_SESSION['phone'] = $_POST['phone'] ?? null;
$_SESSION['date'] = $_POST['date'] ?? null;
$_SESSION['time'] = $_POST['time'] ?? null;
$_SESSION['people'] = $_POST['people'] ?? null;


$date = $_POST['date'];
$time = $_POST['time'];
$people = $_POST['people'];



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
      
      background-color: #f0f0f0;
      
      color: #333;
     
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
      <form action="payment.php" method="POST">
        <input type="hidden" name="date" value="<?php echo $date; ?>">
        <input type="hidden" name="time" value="<?php echo $time; ?>">
        <input type="hidden" id="selectedTables" name="tables"> 

        <div class="tables"></div>
        <br>
        <div id='capacity'></div>
        <br>
        <div id="price"></div>
        <br>
        <button type="submit" id="confirmButton">Confirm Reservation</button>
      </form>


    </section>
  </main>




</body>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }

  document.addEventListener("DOMContentLoaded", function() {
    const selectedDate = "<?php echo  htmlspecialchars($date) ?>";
    const selectedTime = "<?php echo  htmlspecialchars($time) ?>";

    if (!selectedDate || !selectedTime) {
      alert("Date and Time are required!");
      window.location.href = "http://localhost/modern-eats/reservation/booking.php";
      return;
    }

    const tab = document.querySelector(".tables");
    const selectedTables = new Set();
    const hiddenInput = document.getElementById("selectedTables");
    const people = parseInt("<?php echo $people ?>");
    const confirmButton = document.getElementById("confirmButton");

    let totalCapacity = 0;
    let cost = 0;

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
        // console.log("Reserved tables fetched:", await response.json());

        return await response.json();
      } catch (error) {
        console.error("Error:", error);
        return [];
      }
    }

    async function renderTables() {
      const reservedTables = await fetchReservedTables();
      const reservedSet = new Set(reservedTables.map(id => id.toString()));


      for (let index = 1; index <= 17; index++) {
        const div = document.createElement("div");
        div.className = "sec";
        div.textContent = `Table ${index}`;
        div.dataset.tableId = index;
        div.dataset.price = 100;
        div.dataset.capacity = 2;

        if ([1, 2, 3, 4, 16, 17].includes(index)) {
          div.dataset.price = 200;
          div.dataset.capacity = 4;
        }

        if (reservedSet.has(index.toString())) {
          div.classList.add("disabled");
          div.dataset.reserved = "true"; // just a flag, no pointer-events
          div.style.opacity = "0.5";
        }

        tab.appendChild(div);
      }
    }

    renderTables();

    tab.addEventListener("click", function(event) {
      const clickedDiv = event.target.closest('.sec');

      if (!clickedDiv) return; // If not clicking on a table div, ignore

      if (clickedDiv.classList.contains("disabled")) return; // If disabled, ignore

      const tableId = clickedDiv.dataset.tableId;
      const tablePrice = parseInt(clickedDiv.dataset.price);
      const tableCapacity = parseInt(clickedDiv.dataset.capacity);
      const priceDisplay = document.getElementById('price');
      const capacity = document.getElementById('capacity');

      if (selectedTables.has(tableId)) {
        // Unselect
        selectedTables.delete(tableId);
        clickedDiv.style.backgroundColor = "";
        clickedDiv.style.color = "";
        cost -= tablePrice;
        totalCapacity -= tableCapacity;
      } else {
        // Select
        selectedTables.add(tableId);
        clickedDiv.style.backgroundColor = "#ff5733";
        clickedDiv.style.color = "white";
        cost += tablePrice;
        totalCapacity += tableCapacity;
      }
      console.log("Clicked Table:", clickedDiv.dataset.tableId, "Disabled:", clickedDiv.classList.contains("disabled"));

      hiddenInput.value = Array.from(selectedTables).join(",");
      priceDisplay.textContent = `Price: ₹${cost}`;
      capacity.textContent = `People: ${totalCapacity}`;

      // Enable/disable confirm button based on seats selected
      if (totalCapacity >= people) {
        confirmButton.disabled = false;

        // Disable all unselected table buttons
        const tableButtons = document.querySelectorAll('.sec'); // change selector if needed

        tableButtons.forEach(button => {
          const tabId = button.dataset.tableId; // assuming you store table id like this

          if (!selectedTables.has(tabId)) { // if the table is not in selected set
            button.classList.add("disabled");
          }
        });

      } else {
        confirmButton.disabled = true;

        // Re-enable all table buttons
        const tableButtons = document.querySelectorAll('.sec');

        tableButtons.forEach(button => {
          button.classList.remove("disabled");
        });
      }
       sessionStorage.setItem('cost',cost);
    });
  });
</script>

</html>