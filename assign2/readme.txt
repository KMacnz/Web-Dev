CabsOnline - A Simple Taxi Booking System
This is a web-based taxi booking system that allows passengers to book taxi services from any of their internet connected computers or mobile phones. 
It is built using simple Ajax techniques, PHP, and MySQL.

Files:
    admin.html
    admin.js
    admin.php

    booking.html
    booking.js
    booking.php

    index.html
    styles.css
    settings.php (for database connection)

    mysqlcommand.txt
    readme.txt

Instructions on how to use the system:

The CabsOnline taxi booking system has two components:

Booking component: allows a passenger to submit a taxi booking request in Auckland and its surrounding areas.
Admin component: allows an administrator to view and manage all taxi booking requests.

The booking component has the following features:
- Passengers can enter their details, including name, phone number, pickup address, and destination address.
- The system generates a unique booking reference number and stores the booking details in a MySQL database.
- Passengers receive a confirmation message with their booking reference number, pickup time, and pickup date and pickup address.

The admin component has the following features:
- Administrators can view all booking requests and their status (unassigned, assigned).
- Administrators can update the status of a booking request (assign a driver).