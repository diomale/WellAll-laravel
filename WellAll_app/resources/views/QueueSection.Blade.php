@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-success text-center">Queue List</h2>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-success">
                    <tr>
                        <th>Queue #</th>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th>Status</th>
                        <th>Time Added</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($queues as $queue)
                        <tr>
                            <td>{{ $queue->QueueNumber }}</td>
                            <td>
                                @if($queue->patient)
                                    {{ $queue->patient->PatientFirstName }} {{ $queue->patient->PatientLastName }}
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if($queue->doctor)
                                    Dr. {{ $queue->doctor->DoctorFirstName }} {{ $queue->doctor->DoctorLastName }}
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>

                            {{-- Manual Status Dropdown --}}
                            <td>
                                <form action="{{ route('queue.update', $queue->QueueID) }}" method="POST" class="d-flex justify-content-center align-items-center gap-2">
                                    @csrf
                                    <select name="status" class="form-select form-select-sm w-auto">
                                        <option value="Waiting" {{ $queue->Status == 'Waiting' ? 'selected' : '' }}>Waiting</option>
                                        <option value="In Progress" {{ $queue->Status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="Done" {{ $queue->Status == 'Done' ? 'selected' : '' }}>Done</option>
                                        <option value="Cancelled" {{ $queue->Status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                            </td>

                            <td>{{ \Carbon\Carbon::parse($queue->TimeAdded)->format('F d, Y h:i A') }}</td>

                            {{-- Update Button --}}
                            <td>
                                <button type="submit" class="btn btn-success btn-sm w-100">Update</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-muted">No queue data found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
