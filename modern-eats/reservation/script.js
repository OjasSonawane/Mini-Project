
      if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

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
      const people = "<?php echo $people ?>";
      for (let index = 1; index <= 17; index++) {
        const div = document.createElement("div");
        div.className = "sec";
        div.textContent = `Table ${index}`;
        div.dataset.tableId = index;
        div.dataset.price = 100;
        div.dataset.capacity=2;
        if(index==1 || index==2 || index==3 || index==4 || index==16 || index==17){

          div.dataset.price = 200;
          div.dataset.capacity=4;
        }

        if (reservedTables.includes(index) ) {
          div.classList.add("disabled");
          div.style.pointerEvents = "none";
          div.style.opacity = "0.5";
        }

        tab.appendChild(div);
      }
    }

    renderTables();
    let cost = 0;

    tab.addEventListener("click", function(event) {
      const clickedDiv = event.target;

      if (clickedDiv.classList.contains("sec") && !clickedDiv.classList.contains("disabled")) {
        const tableId = clickedDiv.dataset.tableId;
        const tablePrice = clickedDiv.dataset.price;
        const price = document.getElementById('price');

        if (selectedTables.has(tableId)) {
          selectedTables.delete(tableId);
          clickedDiv.style.backgroundColor = "";
          clickedDiv.style.color = "";
          cost = cost - parseInt(tablePrice);
          price.textContent = `₹${cost}`;
        } else {
          selectedTables.add(tableId);
          clickedDiv.style.backgroundColor = "#ff5733";
          clickedDiv.style.color = "white";
          cost = cost + parseInt(tablePrice);
          price.textContent = `₹${cost}`;
        }

        hiddenInput.value = Array.from(selectedTables).join(",");
      }
    });
  });
