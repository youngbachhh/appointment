<!DOCTYPE html>
<html>
<head>
    <title>Appointment Reminder</title>
</head>
<body>
    <h1>Appointment Reminder</h1>
    <p>This is a reminder for your appointment.</p>
    <p>Details:</p>
    <ul>
        <li>Date: {{ $appointment->date }}</li>
        <li>Time: {{ $appointment->start_time }}</li>
        <li>With: {{ $appointment->with }}</li>
    </ul>
</body>
</html>