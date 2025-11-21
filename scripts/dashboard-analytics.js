// BAR CHART - Ticket Sales
const ctx1 = document.getElementById("ticketChart");

new Chart(ctx1, {
  type: "bar",
  data: {
    labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
    datasets: [{
      label: "Tickets",
      data: [42, 60, 30, 35, 55, 80, 50],
      backgroundColor: "#3b82f6"
    }]
  },
  options: {
    indexAxis: 'y',
    responsive: true,
    plugins: { legend: { display: true } }
  }
});


// PIE CHART - Popular Airlines
const ctx2 = document.getElementById("airlineChart");

new Chart(ctx2, {
  type: "pie",
  data: {
    labels: ["Batik Air", "Garuda Air", "Citilink", "Lion Air", "Sriwijaya Air"],
    datasets: [{
      data: [65, 52, 37, 49, 32],
      backgroundColor: [
        "#1e40af",
        "#3b82f6",
        "#60a5fa",
        "#93c5fd",
        "#bfdbfe"
      ]
    }]
  },
  options: {
    responsive: true
  }
});
