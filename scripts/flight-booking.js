// File: scripts/flight-booking.js

document.addEventListener('DOMContentLoaded', function() {
    setupFlightBooking();
});

function setupFlightBooking() {
    // Setup event listeners untuk tombol "Choose" di setiap flight card
    const chooseButtons = document.querySelectorAll('.flight-card .choose-btn');
    
    chooseButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const flightCard = this.closest('.flight-card');
            const flightId = flightCard.dataset.flightId || extractFlightId(flightCard);
            
            // Tampilkan modal untuk memilih jumlah penumpang
            showPassengerSelectionModal(flightId);
        });
    });
}

function extractFlightId(flightCard) {
    // Jika data-flight-id tidak tersedia, coba extract dari konten card
    const flightInfo = flightCard.querySelector('.flight-details');
    if (flightInfo) {
        const text = flightInfo.textContent;
        const match = text.match(/Flight ID: (\d+)/);
        if (match) return match[1];
    }
    return null;
}

function showPassengerSelectionModal(flightId) {
    if (!flightId) {
        alert('Flight ID not found');
        return;
    }
    
    // Buat modal HTML
    const modalHTML = `
        <div id="passengerModal" class="modal-overlay">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Select Passengers & Class</h2>
                    <button class="modal-close" onclick="closeModal()">&times;</button>
                </div>
                
                <div class="modal-body">
                    <div class="form-group">
                        <label>Number of Passengers:</label>
                        <select id="passengerCount" class="form-control">
                            <option value="1">1 Passenger</option>
                            <option value="2">2 Passengers</option>
                            <option value="3">3 Passengers</option>
                            <option value="4">4 Passengers</option>
                            <option value="5">5 Passengers</option>
                            <option value="6">6 Passengers</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Class:</label>
                        <select id="classType" class="form-control">
                            <option value="Economy">Economy</option>
                            <option value="Business">Business</option>
                            <option value="First">First Class</option>
                        </select>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                    <button class="btn btn-primary" onclick="proceedToBooking('${flightId}')">Continue to Booking</button>
                </div>
            </div>
        </div>
    `;
    
    // Hapus modal lama jika ada
    const oldModal = document.getElementById('passengerModal');
    if (oldModal) oldModal.remove();
    
    // Tambah modal ke DOM
    document.body.insertAdjacentHTML('beforeend', modalHTML);
    
    // Styling modal
    addModalStyles();
}

function closeModal() {
    const modal = document.getElementById('passengerModal');
    if (modal) modal.remove();
}

function proceedToBooking(flightId) {
    const passengerCount = document.getElementById('passengerCount').value;
    const classType = document.getElementById('classType').value;
    
    if (!passengerCount || !classType) {
        alert('Please select passengers and class');
        return;
    }
    
    // Store data di sessionStorage untuk digunakan di halaman berikutnya
    sessionStorage.setItem('selected_flight_id', flightId);
    sessionStorage.setItem('passenger_count', passengerCount);
    sessionStorage.setItem('class_type', classType);
    
    // Fetch flight details terlebih dahulu
    fetchFlightDetailsAndRedirect(flightId);
}

function fetchFlightDetailsAndRedirect(flightId) {
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
            // Store flight data
            sessionStorage.setItem('flight_data', JSON.stringify(data.data));
            
            // Redirect to ticket info page
            window.location.href = '/pages/ticket-info.php';
        } else {
            alert('Failed to fetch flight details: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while fetching flight details');
    });
}

function addModalStyles() {
    if (document.getElementById('modalStyles')) return;
    
    const styles = `
        #passengerModal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10000;
            animation: fadeIn 0.3s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .modal-content {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            animation: slideUp 0.3s ease-out;
        }
        
        @keyframes slideUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        .modal-header {
            padding: 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-header h2 {
            margin: 0;
            font-size: 20px;
            color: #1f2937;
        }
        
        .modal-close {
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: #6b7280;
            transition: color 0.2s;
        }
        
        .modal-close:hover {
            color: #1f2937;
        }
        
        .modal-body {
            padding: 24px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group:last-child {
            margin-bottom: 0;
        }
        
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #374151;
            font-size: 14px;
        }
        
        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            cursor: pointer;
            transition: border-color 0.2s;
        }
        
        .form-control:hover {
            border-color: #9ca3af;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #2e85d8;
            box-shadow: 0 0 0 3px rgba(46, 133, 216, 0.1);
        }
        
        .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }
        
        .btn {
            padding: 10px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 14px;
        }
        
        .btn-primary {
            background: #2e85d8;
            color: white;
        }
        
        .btn-primary:hover {
            background: #256fbf;
        }
        
        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
        }
        
        .btn-secondary:hover {
            background: #e5e7eb;
        }
    `;
    
    const styleSheet = document.createElement('style');
    styleSheet.id = 'modalStyles';
    styleSheet.textContent = styles;
    document.head.appendChild(styleSheet);
}

// Jika pengguna langsung membuat booking tanpa pilihan penumpang
function quickBookFlight(flightId, passengerCount = 1, classType = 'Economy') {
    sessionStorage.setItem('selected_flight_id', flightId);
    sessionStorage.setItem('passenger_count', passengerCount);
    sessionStorage.setItem('class_type', classType);
    
    fetchFlightDetailsAndRedirect(flightId);
}

// Update script di flight page untuk menampilkan flight cards dengan proper structure
function displayFlights(flights) {
    const flightList = document.querySelector('.flight-list');
    if (!flightList) return;
    
    flightList.innerHTML = '';
    
    flights.forEach(flight => {
        const flightCard = document.createElement('div');
        flightCard.className = 'flight-card';
        flightCard.dataset.flightId = flight.flights_id;
        
        const departureTime = flight.departure_time.substring(0, 5);
        const arrivalTime = flight.arrival_time.substring(0, 5);
        
        flightCard.innerHTML = `
            <div class="airline-info">
                <img src="/FOTO/airline-logo.png" alt="airline" class="airline-logo">
                <span class="airline-name">${flight.airline}</span>
            </div>
            
            <div class="flight-details">
                <div class="time-section">
                    <div class="time">${departureTime}</div>
                    <div class="airport">${flight.departure_airport}</div>
                    <div class="airport-name">${flight.departure_city}</div>
                </div>
                
                <div class="flight-path">
                    <div class="path-label">${flight.class || 'Economy'}</div>
                    <div class="path-line"></div>
                    <div class="duration">${flight.duration || '2h 30m'}</div>
                </div>
                
                <div class="time-section">
                    <div class="time">${arrivalTime}</div>
                    <div class="airport">${flight.arrival_airport}</div>
                    <div class="airport-name">${flight.arrival_city}</div>
                </div>
            </div>
            
            <div class="flight-info">
                <div class="info-item">Class: ${flight.class || 'Economy'}</div>
                <div class="info-item">Seats: ${flight.available_seats}</div>
                <div class="info-item">Date: ${flight.flight_date}</div>
            </div>
            
            <div class="price-section">
                <div class="price">Rp. ${formatPrice(flight.price)}</div>
                <button class="choose-btn">Choose</button>
            </div>
        `;
        
        flightList.appendChild(flightCard);
    });
    
    // Reinitialize event listeners
    setupFlightBooking();
}

function formatPrice(price) {
    return new Intl.NumberFormat('id-ID').format(price);
}

document.addEventListener('DOMContentLoaded', function() {
    fetchAvailableFlights();
});

function fetchAvailableFlights() {
    const from = document.querySelector('input[name="from"]')?.value || '';
    const to = document.querySelector('input[name="to"]')?.value || '';
    const date = document.querySelector('input[name="depart"]')?.value || '';
    const passengers = document.querySelector('input[name="pax"]')?.value || '1';
    const classType = document.querySelector('input[name="class"]')?.value || 'Economy';
    
    const params = new URLSearchParams({
        from: from,
        to: to,
        date: date,
        passengers: passengers,
        class: classType
    });
    
    fetch('/backend/flight-api.php?' + params)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                displayFlights(data.data);
            }
        })
        .catch(error => console.error('Error:', error));
}