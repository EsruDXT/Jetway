// Ticket Info Page Handler
document.addEventListener('DOMContentLoaded', function() {
    loadSelectedFlight();
    setupAddonsSelection();
    setupConfirmButton();
});

// Load selected flight details
function loadSelectedFlight() {
    const flightId = sessionStorage.getItem('selected_flight_id');
    const passengerCount = sessionStorage.getItem('passenger_count') || 1;
    
    if (!flightId) {
        alert('No flight selected. Please select a flight first.');
        window.location.href = '/pages/Flights.php';
        return;
    }
    
    const formData = new FormData();
    formData.append('action', 'get_flight');
    formData.append('flight_id', flightId);
    
    fetch('/backend/flights-api.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            displayFlightInfo(data.data, passengerCount);
            calculateTotalPrice(data.data, passengerCount);
        } else {
            alert('Failed to load flight details');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred');
    });
}

// Display flight information
function displayFlightInfo(flight, passengerCount) {
    // Update departure flight info
    const departureSection = document.querySelector('.flight-row:first-child');
    if (departureSection) {
        departureSection.querySelector('.route').textContent = 
            `${flight.departure_city}-${flight.arrival_city}`;
        departureSection.querySelector('.flight-info-left .flight-time').textContent = 
            formatTime(flight.departure_time);
        departureSection.querySelector('.flight-info-left .flight-city').textContent = 
            `${flight.departure_city} - ${flight.departure_airport}`;
        departureSection.querySelector('.flight-info-right .flight-time').textContent = 
            formatTime(flight.arrival_time);
        departureSection.querySelector('.flight-info-right .flight-city').textContent = 
            `${flight.arrival_city} - ${flight.arrival_airport}`;
        departureSection.querySelector('.flight-duration').textContent = 
            flight.duration;
    }
    
    // Update base price
    const basePrice = flight.price * passengerCount;
    updatePriceDisplay('original-price', basePrice);
    
    // Store flight data
    sessionStorage.setItem('flight_data', JSON.stringify(flight));
}

// Setup addons selection
function setupAddonsSelection() {
    const addonCheckboxes = document.querySelectorAll('.insurance-option input[type="checkbox"]');
    
    addonCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            recalculateTotal();
        });
    });
}

// Calculate and display total price
function calculateTotalPrice(flight, passengerCount) {
    const basePrice = flight.price * passengerCount;
    
    // Update price displays
    document.querySelector('.price-row:first-child .price-value').textContent = 
        `Rp. ${formatPrice(basePrice)}`;
    
    recalculateTotal();
}

// Recalculate total with addons
function recalculateTotal() {
    const flightData = JSON.parse(sessionStorage.getItem('flight_data'));
    const passengerCount = parseInt(sessionStorage.getItem('passenger_count')) || 1;
    
    if (!flightData) return;
    
    let basePrice = flightData.price * passengerCount;
    let insurancePrice = 0;
    let baggagePrice = 0;
    let delayPrice = 0;
    
    // Check selected addons
    const travelInsurance = document.querySelector('input[data-addon="travel_insurance"]');
    const baggageProtection = document.querySelector('input[data-addon="baggage_protection"]');
    const delayCompensation = document.querySelector('input[data-addon="delay_compensation"]');
    
    if (travelInsurance && travelInsurance.checked) {
        insurancePrice = 225000 * passengerCount;
    }
    if (baggageProtection && baggageProtection.checked) {
        baggagePrice = 30000 * passengerCount;
    }
    if (delayCompensation && delayCompensation.checked) {
        delayPrice = 200000 * passengerCount;
    }
    
    // Update insurance price display
    if (insurancePrice > 0) {
        const insuranceRow = document.querySelector('.price-row:nth-child(2)');
        if (insuranceRow) {
            insuranceRow.style.display = 'flex';
            insuranceRow.querySelector('.price-value').textContent = 
                `Rp. ${formatPrice(insurancePrice)}`;
        }
    }
    
    const totalPrice = basePrice + insurancePrice + baggagePrice + delayPrice;
    
    // Update total display
    const totalElement = document.querySelector('.total-value');
    if (totalElement) {
        totalElement.textContent = `Rp. ${formatPrice(totalPrice)}`;
    }
    
    // Store total for next page
    sessionStorage.setItem('total_price', totalPrice);
}

// Setup confirm button
function setupConfirmButton() {
    const confirmBtn = document.querySelector('.confirm-button');
    
    if (confirmBtn) {
        confirmBtn.addEventListener('click', function() {
            const flightId = sessionStorage.getItem('selected_flight_id');
            const passengerCount = sessionStorage.getItem('passenger_count');
            
            // Get selected addons
            const addons = {
                travel_insurance: document.querySelector('input[data-addon="travel_insurance"]')?.checked || false,
                baggage_protection: document.querySelector('input[data-addon="baggage_protection"]')?.checked || false,
                delay_compensation: document.querySelector('input[data-addon="delay_compensation"]')?.checked || false
            };
            
            // Store addons selection
            sessionStorage.setItem('selected_addons', JSON.stringify(addons));
            
            // Proceed to customer data input page
            window.location.href = '/pages/customer-data-input.php';
        });
    }
}

// Helper functions
function formatTime(time) {
    return time.substring(0, 5);
}

function formatPrice(price) {
    return new Intl.NumberFormat('id-ID').format(price);
}

function updatePriceDisplay(elementClass, price) {
    const element = document.querySelector(`.${elementClass}`);
    if (element) {
        element.textContent = `Rp. ${formatPrice(price)}`;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const flightData = JSON.parse(sessionStorage.getItem('flight_data'));
    const passengerCount = sessionStorage.getItem('passenger_count');
    
    if (flightData) {
        displayFlightOnPage(flightData, passengerCount);
    }
});