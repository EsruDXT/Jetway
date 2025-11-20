// Load selected flight details
document.addEventListener('DOMContentLoaded', function() {
    loadSelectedFlight();
    setupAddonsSelection();
    setupConfirmButton();
});

// Load flight data from session storage
function loadSelectedFlight() {
    const flightId = sessionStorage.getItem('selected_flight_id');
    const passengerCount = parseInt(sessionStorage.getItem('passenger_count')) || 1;
    
    if (!flightId) {
        alert('No flight selected. Please select a flight first.');
        window.location.href = '/pages/Flights.php';
        return;
    }
    
    // Fetch flight details from API
    const formData = new FormData();
    formData.append('action', 'get_flight');
    formData.append('flight_id', flightId);
    
    fetch('/backend/flight-api.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            displayFlightInfo(data.data, passengerCount);
            calculateTotalPrice(data.data, passengerCount);
        } else {
            alert('Failed to load flight details: ' + data.message);
            window.location.href = '/pages/Flights.php';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while loading flight details');
    });
}

// Display flight information
function displayFlightInfo(flight, passengerCount) {
    // Update departure info
    const departureTime = document.querySelector('.flight-row:first-child .time:first-child');
    const departureCity = document.querySelector('.flight-row:first-child .location:first-child');
    
    if (departureTime) departureTime.textContent = formatTime(flight.departure_time);
    if (departureCity) departureCity.textContent = `${flight.departure_city} - ${flight.departure_airport}`;
    
    // Update arrival info
    const arrivalTime = document.querySelector('.flight-row:first-child .time:last-child');
    const arrivalCity = document.querySelector('.flight-row:first-child .location:last-child');
    
    if (arrivalTime) arrivalTime.textContent = formatTime(flight.arrival_time);
    if (arrivalCity) arrivalCity.textContent = `${flight.arrival_city} - ${flight.arrival_airport}`;
    
    // Update route
    const route = document.querySelector('.flight-row .route');
    if (route) route.textContent = `${flight.departure_city}-${flight.arrival_city}`;
    
    // Update duration
    const duration = document.querySelector('.flight-duration');
    if (duration) duration.textContent = flight.duration;
    
    // Store flight data for later use
    sessionStorage.setItem('flight_data', JSON.stringify(flight));
}

// Calculate and display total price
function calculateTotalPrice(flight, passengerCount) {
    const basePrice = parseFloat(flight.price) * passengerCount;
    
    // Display original price
    const originalPriceElement = document.querySelector('.price-row:first-child .price-value');
    if (originalPriceElement) {
        originalPriceElement.textContent = `Rp ${formatPrice(basePrice)}`;
    }
    
    // Initial total
    updateTotalDisplay(basePrice);
    
    // Store base price
    sessionStorage.setItem('base_price', basePrice);
}

// Setup addons selection checkboxes
function setupAddonsSelection() {
    const addonCheckboxes = document.querySelectorAll('.insurance-option input[type="checkbox"]');
    
    addonCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            recalculateTotal();
        });
    });
}

// Recalculate total when addons change
function recalculateTotal() {
    const flightData = JSON.parse(sessionStorage.getItem('flight_data'));
    const passengerCount = parseInt(sessionStorage.getItem('passenger_count')) || 1;
    
    if (!flightData) return;
    
    let basePrice = parseFloat(flightData.price) * passengerCount;
    let addonTotal = 0;
    
    // Check travel insurance
    const travelInsurance = document.querySelector('input[data-addon="travel_insurance"]');
    if (travelInsurance && travelInsurance.checked) {
        addonTotal += 225000 * passengerCount;
    }
    
    // Check baggage protection
    const baggageProtection = document.querySelector('input[data-addon="baggage_protection"]');
    if (baggageProtection && baggageProtection.checked) {
        addonTotal += 30000 * passengerCount;
    }
    
    // Check delay compensation
    const delayCompensation = document.querySelector('input[data-addon="delay_compensation"]');
    if (delayCompensation && delayCompensation.checked) {
        addonTotal += 200000 * passengerCount;
    }
    
    const totalPrice = basePrice + addonTotal;
    
    // Update total display
    updateTotalDisplay(totalPrice);
    
    // Store total for payment page
    sessionStorage.setItem('total_price', totalPrice);
}

// Update total price display
function updateTotalDisplay(amount) {
    const totalElement = document.querySelector('.total-value, .subtotal-row div:last-child');
    if (totalElement) {
        totalElement.textContent = `Rp ${formatPrice(amount)}`;
    }
}

// Setup confirm button
function setupConfirmButton() {
    const confirmBtn = document.querySelector('.confirm-button');
    
    if (confirmBtn) {
        confirmBtn.addEventListener('click', function() {
            // Get selected addons
            const addons = {
                travel_insurance: document.querySelector('input[data-addon="travel_insurance"]')?.checked || false,
                baggage_protection: document.querySelector('input[data-addon="baggage_protection"]')?.checked || false,
                delay_compensation: document.querySelector('input[data-addon="delay_compensation"]')?.checked || false
            };
            
            // Store addons selection
            sessionStorage.setItem('selected_addons', JSON.stringify(addons));
            
            // Redirect to payment page
            window.location.href = '/pages/payment.php';
        });
    }
}

// Helper functions
function formatTime(time) {
    return time.substring(0, 5); // Format HH:MM
}

function formatPrice(price) {
    return new Intl.NumberFormat('id-ID').format(price);
}