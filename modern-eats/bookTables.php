<?php

if(isset($_POST['name'])){
  $name = $_POST['name'];
}
if(isset($_POST['phone'])){
  $phone = $_POST['phone'];
}
if(isset($_POST['date'])){
  $date = $_POST['date'];
}
if(isset($_POST['time'])){
  $time = $_POST['time'];
}
if(isset($_POST['people'])){
  $people = $_POST['people'];
}





?>













<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book a Table</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles/booking.css">
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
  </style>

</head>

<body>

  <header>
    <div class="logo">Modern Eats</div>
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="#menu">Menu</a></li>
      <li><a href="booking.php">Reservation</a></li>
    </ul>
  </header>


  <main class="main-container">
    <section class="form-container">
      <img src="tableLayout.png" alt="table" width="100%">
      <div class="tables">

      </div>
    </section>
  </main>




</body>
<script>
  const tab = document.querySelector(".tables");
  for (let index = 0; index < 18; index++) {

    const div = document.createElement('div');
    div.className = "sec";
    div.textContent = `Table ${index}`;
    tab.appendChild(div);

  }
  tab.addEventListener("click", function(event) {
    const clickedDiv = event.target;

    // Ensure the click is on a table div
    if (clickedDiv.classList.contains("sec")) {
      // Toggle the background color
      clickedDiv.style.backgroundColor =
      clickedDiv.style.backgroundColor === "rgb(255, 87, 51)" ? "" : "#ff5733";
      clickedDiv.style.color = clickedDiv.style.backgroundColor ? "white" : "";
    }
  });
</script>

</html>