
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
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
            button.disabled = true;
          }
        });

      } else {
        confirmButton.disabled = true;

        // Re-enable all table buttons
        const tableButtons = document.querySelectorAll('.sec');

        tableButtons.forEach(button => {
          button.disabled = false;
        });
      }

    });
  });
