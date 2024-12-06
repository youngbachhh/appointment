<!DOCTYPE html>
<html>
<head>
    <title>Appointment Created</title>
</head>
<body>
    <h1>Appointment Created Successfully</h1>
    <p>Your appointment has been created successfully.</p>
    <p>Details:</p>
    <ul>
        <li>Date: {{ $appointment->date }}</li>
        <li>Time: {{ $appointment->time }}</li>
        <li>With: {{ $appointment->with }}</li>
    </ul>
</body>
</html>