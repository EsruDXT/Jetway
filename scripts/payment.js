document.addEventListener('DOMContentLoaded', function() {
    loadPaymentSummary();
    setupPaymentMethods();
    setupVoucherValidation();
    setupConfirmPayment();
});

let selectedPaymentMethod = '';
let currentTotal = 0;

// Load payment summary
function loadPaymentSummary() {
    const flightData = JSON.parse(sessionStorage.getItem('flight_data'));
    const passengerCount = parseInt(sessionStorage.getItem('passenger_count')) || 1;
    const totalPrice = parseFloat(sessionStorage.getItem('total_price')) || 0;
    const addons = JSON.parse(sessionStorage.getItem('selected_addons')) || {};
    
    if (!flightData) {
        alert('No booking data found');
        window.location.href = '/pages/Flights.php';
        return;
    }
    
    currentTotal = totalPrice;
    
    // Display flight summary
    displayFlightSummary(flightData);
    
    // Display price breakdown
    displayPriceBreakdown(flightData, passengerCount, addons);
    
    // Display total
    updateTotalDisplay(totalPrice);
}

// Display flight summary
function displayFlightSummary(flight) {
    const flightCard = document.querySelector('.flight-card');
    if (!flightCard) return;
    
    const departureTime = flightCard.querySelector('.flight-time:first-child');
    const departureCity = flightCard.querySelector('.flight-city:first-child');
    const arrivalTime = flightCard.querySelector('.flight-time:last-child');
    const arrivalCity = flightCard.querySelector('.flight-city:last-child');
    const duration = flightCard.querySelector('.flight-duration');
    
    if (departureTime) departureTime.textContent = formatTime(flight.departure_time);
    if (departureCity) departureCity.textContent = `${flight.departure_city} - ${flight.departure_airport}`;
    if (arrivalTime) arrivalTime.textContent = formatTime(flight.arrival_time);
    if (arrivalCity) arrivalCity.textContent = `${flight.arrival_city} - ${flight.arrival_airport}`;
    if (duration) duration.textContent = flight.duration;
}

// Display price breakdown
function displayPriceBreakdown(flight, passengerCount, addons) {
    const basePrice = parseFloat(flight.price) * passengerCount;
    let addonTotal = 0;
    
    const priceDetails = document.querySelector('.price-details');
    if (!priceDetails) return;
    
    // Clear existing prices
    priceDetails.innerHTML = '';
    
    // Add original price
    priceDetails.innerHTML += `
        <div class="price-row">
            <span class="price-label">Original Price (${passengerCount} pax)</span>
            <span class="price-value">Rp ${formatPrice(basePrice)}</span>
        </div>
    `;
    
    // Add addons if selected
    if (addons.travel_insurance) {
        const insurancePrice = 225000 * passengerCount;
        addonTotal += insurancePrice;
        priceDetails.innerHTML += `
            <div class="price-row">
                <span class="price-label">Travel Insurance</span>
                <span class="price-value">Rp ${formatPrice(insurancePrice)}</span>
            </div>
        `;
    }
    
    if (addons.baggage_protection) {
        const baggagePrice = 30000 * passengerCount;
        addonTotal += baggagePrice;
        priceDetails.innerHTML += `
            <div class="price-row">
                <span class="price-label">Baggage Protection</span>
                <span class="price-value">Rp ${formatPrice(baggagePrice)}</span>
            </div>
        `;
    }
    
    if (addons.delay_compensation) {
        const delayPrice = 200000 * passengerCount;
        addonTotal += delayPrice;
        priceDetails.innerHTML += `
            <div class="price-row">
                <span class="price-label">Delay Compensation</span>
                <span class="price-value">Rp ${formatPrice(delayPrice)}</span>
            </div>
        `;
    }
}

// Setup payment method selection
function setupPaymentMethods() {
    const paymentOptions = document.querySelectorAll('.payment-option');
    
    paymentOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Remove selected class from all
            paymentOptions.forEach(opt => opt.classList.remove('selected'));
            
            // Add selected class to clicked option
            this.classList.add('selected');
            this.style.borderColor = '#2e85d8';
            this.style.backgroundColor = '#f0f9ff';
            
            // Store selected payment method
            const methodText = this.querySelector('span').textContent.trim();
            if (methodText.includes('Credit') || methodText.includes('Debit')) {
                selectedPaymentMethod = 'credit_card';
            } else if (methodText.includes('Digital')) {
                selectedPaymentMethod = 'digital_wallet';
            } else if (methodText.includes('Bank')) {
                selectedPaymentMethod = 'bank_transfer';
            }
        });
    });
}

// Setup voucher validation
function setupVoucherValidation() {
    const voucherInput = document.querySelector('.voucher-input');
    
    // Create apply button if not exists
    let applyBtn = document.querySelector('.voucher-apply-btn');
    if (!applyBtn && voucherInput) {
        applyBtn = document.createElement('button');
        applyBtn.textContent = 'Apply';
        applyBtn.className = 'voucher-apply-btn';
        applyBtn.style.cssText = 'margin-left:10px;padding:8px 16px;background:#2e85d8;color:white;border:none;border-radius:6px;cursor:pointer;';
        voucherInput.parentElement.appendChild(applyBtn);
        
        applyBtn.addEventListener('click', function() {
            const voucherCode = voucherInput.value.trim();
            
            if (!voucherCode) {
                alert('Please enter a voucher code');
                return;
            }
            
            validateVoucherCode(voucherCode);
        });
    }
}

// Validate voucher code
function validateVoucherCode(code) {
    const formData = new FormData();
    formData.append('action', 'validate_voucher');
    formData.append('voucher_code', code);
    formData.append('amount', currentTotal);
    
    fetch('/backend/payment-api.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Voucher applied: ' + data.message);
            
            const discountAmount = parseFloat(data.discount);
            const newTotal = currentTotal - discountAmount;
            
            // Add discount row
            const priceDetails = document.querySelector('.price-details');
            const discountRow = document.createElement('div');
            discountRow.className = 'price-row discount-row';
            discountRow.innerHTML = `
                <span class="price-label" style="color:#22c55e;">Discount (${code})</span>
                <span class="price-value" style="color:#22c55e;">- Rp ${formatPrice(discountAmount)}</span>
            `;
            priceDetails.appendChild(discountRow);
            
            // Update total
            updateTotalDisplay(newTotal);
            currentTotal = newTotal;
            
            // Store voucher
            sessionStorage.setItem('voucher_code', code);
            sessionStorage.setItem('discount_amount', discountAmount);
        } else {
            alert('Voucher error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to validate voucher');
    });
}

// Setup confirm payment button
function setupConfirmPayment() {
    const confirmBtn = document.querySelector('.confirm-btn');
    
    if (confirmBtn) {
        confirmBtn.addEventListener('click', async function() {
            if (!selectedPaymentMethod) {
                alert('Please select a payment method');
                return;
            }
            
            // Show loading
            confirmBtn.disabled = true;
            confirmBtn.textContent = 'Processing...';
            
            try {
                await processBookingAndPayment();
            } catch (error) {
                console.error('Error:', error);
                alert('Payment failed: ' + error.message);
                confirmBtn.disabled = false;
                confirmBtn.textContent = 'Confirm';
            }
        });
    }
}

// Process complete booking and payment
async function processBookingAndPayment() {
    const flightId = sessionStorage.getItem('selected_flight_id');
    const passengerCount = sessionStorage.getItem('passenger_count');
    const addons = JSON.parse(sessionStorage.getItem('selected_addons')) || {};
    const voucherCode = sessionStorage.getItem('voucher_code') || '';
    
    try {
        // Step 1: Create booking
        const bookingData = await createBooking(flightId, passengerCount, addons);
        
        if (bookingData.status !== 'success') {
            throw new Error(bookingData.message);
        }
        
        const bookingId = bookingData.booking_id;
        
        // Step 2: Process payment
        const paymentData = await processPayment(bookingId, selectedPaymentMethod, voucherCode);
        
        if (paymentData.status !== 'success') {
            throw new Error(paymentData.message);
        }
        
        // Success - store booking code and redirect
        sessionStorage.setItem('booking_code', paymentData.booking_code);
        sessionStorage.setItem('transaction_id', paymentData.transaction_id);
        
        // Redirect to confirmation page
        window.location.href = '/pages/confirmed.php';
        
    } catch (error) {
        throw error;
    }
}

// Create booking via API
function createBooking(flightId, passengerCount, addons) {
    const formData = new FormData();
    formData.append('action', 'create_booking');
    formData.append('flight_id', flightId);
    formData.append('passenger_count', passengerCount);
    
    if (addons.travel_insurance) formData.append('travel_insurance', '1');
    if (addons.baggage_protection) formData.append('baggage_protection', '1');
    if (addons.delay_compensation) formData.append('delay_compensation', '1');
    
    return fetch('/backend/booking-api.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json());
}

// Process payment via API
function processPayment(bookingId, paymentMethod, voucherCode) {
    const formData = new FormData();
    formData.append('action', 'process_payment');
    formData.append('booking_id', bookingId);
    formData.append('payment_method', paymentMethod);
    if (voucherCode) formData.append('voucher_code', voucherCode);
    
    return fetch('/backend/payment-api.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json());
}

// Update total display
function updateTotalDisplay(amount) {
    const totalElement = document.querySelector('.total-value');
    if (totalElement) {
        totalElement.textContent = `Rp ${formatPrice(amount)}`;
    }
}

// Helper functions
function formatTime(time) {
    return time.substring(0, 5);
}

function formatPrice(price) {
    return new Intl.NumberFormat('id-ID').format(price);
}