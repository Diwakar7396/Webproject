// Basic form handling for the booking form
document.getElementById('bookingForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const name = document.getElementById('name').value;
    const vehicle = document.getElementById('vehicle').value;
    const date = document.getElementById('date').value;
    const time = document.getElementById('time').value;
    
    alert(`Booking confirmed!\nName: ${name}\nVehicle: ${vehicle}\nDate: ${date}\nTime: ${time}`);
});
