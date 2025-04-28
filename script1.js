document.addEventListener('DOMContentLoaded', function () {
    const bookingForm = document.getElementById('bookingForm');
    const slotSelect = document.getElementById('slot');
    const slotMessage = document.getElementById('slot-message');
    const bookedSlots = {
        '2025-01-16': {
            'slot1': { time: '09:00', endTime: '11:00' },
            'slot2': { time: '10:00', endTime: '12:00' }
            // Add more booked slots for different dates
        },
        // Other dates can be added here
    };

    // Listen for form submission
    bookingForm.addEventListener('submit', function (e) {
        e.preventDefault();

        // Get user input values
        const bookingDate = document.getElementById('date').value;
        const selectedSlot = slotSelect.value;
        const startTime = document.getElementById('time').value;
        const endTime = document.getElementById('end-time').value;

        // Check if the selected slot is already booked
        if (bookedSlots[bookingDate] && bookedSlots[bookingDate][selectedSlot]) {
            const existingBooking = bookedSlots[bookingDate][selectedSlot];
            if ((startTime >= existingBooking.time && startTime < existingBooking.endTime) || 
                (endTime > existingBooking.time && endTime <= existingBooking.endTime)) {
                slotMessage.textContent = `Sorry, this slot is already booked during the selected time.`;
                return;
            }
        }

        // Proceed with booking (e.g., save the booking details or show a confirmation)
        slotMessage.textContent = '';  // Clear any previous error message
        alert('Your booking has been confirmed!');
        // You can add your booking confirmation logic here
    });
});
