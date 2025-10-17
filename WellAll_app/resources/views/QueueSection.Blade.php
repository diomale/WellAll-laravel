<!DOCTYPE html>
<html>
<head>
    <title>Queue Section</title>
</head>
<body>
    <h1>Queue List</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Queue #</th>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Status</th>
                <th>Time Added</th>
            </tr>
        </thead>
        <tbody>
            @foreach($queues as $queue)
                <tr>
                    <td>{{ $queue->QueueNumber }}</td>
                    <td>{{ $queue->patient->PatientFirstName }} {{ $queue->patient->PatientLastName }}</td>
                    <td>Dr. {{ $queue->doctor->DoctorFirstName }} {{ $queue->doctor->DoctorLastName }}</td>
                    <td>{{ $queue->Status }}</td>
                    <td>{{ $queue->TimeAdded }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{route('dashboard.index')}}">dashboard</a>
    <a href="{{route('AppointmentSection')}}">Appointment</a>
</body>
</html>
