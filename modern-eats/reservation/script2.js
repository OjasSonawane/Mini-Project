

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
  const hiddenInput = document.getElementById("selectedTables"); // Hidden input field
  const people = parseInt("<?php echo $people ?>");
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

      return await response.json();
    } catch (error) {
      console.error("Error:", error);
      return [];
    }
  }

  async function renderTables() {
  const reservedTables = await fetchReservedTables();
  const reservedSet = new Set(reservedTables.map(id => id.toString())); // 🔥 make a Set of string IDs

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
      div.dataset.reserved = "true"; // 🔥 mark specially
      div.style.pointerEvents = "none";
      div.style.opacity = "0.5";
    }

    tab.appendChild(div);
  }
}


  renderTables();

  tab.addEventListener("click", function(event) {
  // Always find the nearest parent with class "sec"
  const clickedDiv = event.target.closest('.sec');

  // If not a table div, ignore
  if (!clickedDiv) return;

  // If disabled table, ignore
  if (clickedDiv.classList.contains("disabled")) return;

  const tableId = clickedDiv.dataset.tableId;
  const tablePrice = parseInt(clickedDiv.dataset.price);
  const tableCapacity = parseInt(clickedDiv.dataset.capacity);
  const priceDisplay = document.getElementById('price');

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

  hiddenInput.value = Array.from(selectedTables).join(",");
  priceDisplay.textContent = `₹${cost}`;

  if (totalCapacity >= people) {
    console.log("✅ Enough seats selected.");
  } else {
    console.log(`❌ Need more seats! Current capacity: ${totalCapacity}, Required: ${people}`);
  }
});


});
const confirmButton = document.getElementById("confirmButton");

if (totalCapacity >= people) {
  confirmButton.disabled = false;
} else {
  confirmButton.disabled = true;
}
if(confirmButton.disabled){
  alert("not enough seat");
}
