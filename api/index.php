<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket Control System</title>
</head>
<body>
    <h1>Ticket Control System</h1>
    
    <h2>add New Ticket</h2>
    <form id="ticketForm">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br><br>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br><br>
        
        <button type="submit">Add Ticket</button>
    </form>
    
    <h2>Tickets</h2>
    <div id="tickets"></div>
    
    <script>
        document.getElementById('ticketForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('add_ticket.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                loadTickets();
            });
        });
        
        function loadTickets() {
            fetch('get_tickets.php')
            .then(response => response.json())
            .then(tickets => {
                const ticketsDiv = document.getElementById('tickets');
                ticketsDiv.innerHTML = '';
                
                tickets.forEach(ticket => {
                    const ticketDiv = document.createElement('div');
                    ticketDiv.innerHTML = `<h3>${ticket.title}</h3><p>${ticket.description}</p>`;
                    ticketsDiv.appendChild(ticketDiv);
                });
            });
        }
        
        // Load tickets on page load
        loadTickets();
    </script>
</body>
</html>
