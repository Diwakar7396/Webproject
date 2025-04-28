// Event listener to update the selected slot and price dynamically when the user selects a slot
document.getElementById('slot').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex]; // Get the selected option
    const slotName = selectedOption.text; // Get the full name of the selected slot (e.g., "Slot 1 - $10")
    const price = selectedOption.getAttribute('data-price'); // Get the price of the selected slot
    
    // Update the display of selected slot and price
    document.getElementById('selected-slot').innerText = slotName;
    document.getElementById('selected-price').innerText = price;

    // Show payment section after a slot is selected
    document.getElementById('payment-section').style.display = 'block';
});

// Handle the form submission
document.getElementById('bookingForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission to handle logic here

    // Gather all input values
    const name = document.getElementById('name').value;
    const vehicle = document.getElementById('vehicle').value;
    const date = document.getElementById('date').value;
    const time = document.getElementById('time').value;
    const endTime = document.getElementById('end-time').value;
    const selectedSlot = document.getElementById('slot').value;
    const price = document.getElementById('selected-price').innerText;
    const exitGate = document.getElementById('exit-gate').value;

    // Display a confirmation message with the booking details
    alert(`Booking Confirmed! \nName: ${name}\nVehicle: ${vehicle}\nDate: ${date}\nTime: ${time} to ${endTime}\nSlot: ${selectedSlot} \nPrice: $${price}\nExit Gate: ${exitGate}`);

    // Optionally, reset the form after submission
    document.getElementById('bookingForm').reset();
    document.getElementById('selected-slot').innerText = 'None';
    document.getElementById('selected-price').innerText = '0';
    document.getElementById('payment-section').style.display = 'none';
});
