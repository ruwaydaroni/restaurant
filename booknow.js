document.getElementById('booking-form').addEventListener('submit', function (event) {
    event.preventDefault();
    const selectedSeats = Array.from(document.querySelectorAll('.seat.selected')).map(seat => seat.getAttribute('data-seat'));

    const bookingData = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        phone: document.getElementById('phone').value,
        date: document.getElementById('date').value,
        time: document.getElementById('time').value,
        guests: document.getElementById('guests').value,
        seats: selectedSeats
    };

    console.log("Sending booking data:", bookingData);

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
            fetchSeats();
            document.getElementById('booking-form').reset();
            document.querySelectorAll('.seat.selected').forEach(seat => {
                seat.classList.remove('selected');
            });
        })
        .catch(error => {
            console.error('Error:', error);
            alert('There was an error booking your seats.');
        });
});
