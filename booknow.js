document.getElementById('booking-form').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    const selectedSeats = Array.from(document.querySelectorAll('.seat.selected')).map(seat => seat.getAttribute('data-seat'));

    const bookingData = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        phone: document.getElementById('phone').value,
        date: document.getElementById('date').value,
        time: document.getElementById('time').value,
        guests: document.getElementById('guests').value,
        seats: selectedSeats // Ensure this is being sent correctly
    };

    console.log("Sending booking data:", bookingData); // Log booking data

    fetch('http://localhost/restaurant/book_seat.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(bookingData)
    })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            fetchSeats(); // Refresh seat status

            // Clear the form fields after successful booking
            document.getElementById('booking-form').reset(); // Resets the form
            // Optionally, clear selected seats visually if needed
            document.querySelectorAll('.seat.selected').forEach(seat => {
                seat.classList.remove('selected'); // Remove the selected class from all seats
            });
        })
        .catch(error => {
            console.error('Error:', error); // Log any errors
            alert('There was an error booking your seats.');
        });
});
