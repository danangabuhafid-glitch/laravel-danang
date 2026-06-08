@extends('Master.layouts.app')
@section('title', 'Locker Management')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ $title }}</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Locker Management</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible show fade">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <section class="section">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createLockerModal">
                    <i class="bi bi-plus"></i> Create Locker
                </button>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Locker Code</th>
                            <th>Owner Name</th>
                            <th>Locker Description</th>
                            <th>Major</th>
                            <th>Locker Status</th>
                            <th>Batch</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lockers as $locker)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $locker->locker_code }}</td>
                            <td>{{ $locker->locker_name }}</td>
                            <td>{{ $locker->locker_description }}</td>
                            <td>{{ $locker->major ?? 'All' }}</td>
                            <td>
                                @if ($locker->locker_status == 'Available')
                                <span class="badge bg-success">Available</span>
                                @elseif ($locker->locker_status == 'Unavailable')
                                <span class="badge bg-secondary">Used</span>
                                @elseif ($locker->locker_status == 'Damaged')
                                <span class="badge bg-warning">Damaged</span>
                                @else
                                <span class="badge bg-danger">Missing</span>
                                @endif
                            </td>
                            <td>{{ $locker->batch ?? 'All' }}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editLockerModal{{ $locker->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteLockerModal{{ $locker->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @include('Admin.Locker.edit')
                        @include('Admin.Locker.delete')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

@include('Admin.Locker.create')

<script>
document.addEventListener('DOMContentLoaded', function() {
    let debounceTimer;
    
    document.addEventListener('input', function(e) {
        if (e.target && e.target.classList.contains('locker-code-input')) {
            const input = e.target;
            const form = input.closest('form');
            const submitBtn = form.querySelector('button[type="submit"]');
            const feedbackDiv = form.querySelector('.locker-code-feedback');
            const val = input.value.trim();
            const originalCode = input.getAttribute('data-original-code');
            const lockerId = input.getAttribute('data-locker-id');

            clearTimeout(debounceTimer);

            if (val === '') {
                feedbackDiv.style.display = 'none';
                feedbackDiv.innerHTML = '';
                submitBtn.disabled = false;
                return;
            }

            // In edit mode: if the typed code is exactly the original code of the locker, it is available
            if (originalCode && val.toLowerCase() === originalCode.toLowerCase()) {
                feedbackDiv.style.display = 'block';
                feedbackDiv.innerHTML = '<span class="text-success"><i class="bi bi-check-circle-fill me-1"></i> Locker code is available</span>';
                submitBtn.disabled = false;
                return;
            }

            feedbackDiv.style.display = 'block';
            feedbackDiv.innerHTML = '<span class="text-muted"><i class="spinner-border spinner-border-sm me-1" style="width: 1rem; height: 1rem;" role="status"></i> Checking availability...</span>';
            submitBtn.disabled = true; // disable while checking to prevent race conditions

            debounceTimer = setTimeout(() => {
                let url = "{{ route('locker.check-code') }}?locker_code=" + encodeURIComponent(val);
                if (lockerId) {
                    url += "&id=" + encodeURIComponent(lockerId);
                }

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data.available) {
                            feedbackDiv.innerHTML = '<span class="text-success"><i class="bi bi-check-circle-fill me-1"></i> Locker code is available</span>';
                            submitBtn.disabled = false;
                        } else {
                            feedbackDiv.innerHTML = '<span class="text-danger"><i class="bi bi-x-circle-fill me-1"></i> Locker code has been used</span>';
                            submitBtn.disabled = true;
                        }
                    })
                    .catch(err => {
                        console.error('Error checking locker code availability:', err);
                        feedbackDiv.innerHTML = '<span class="text-warning"><i class="bi bi-exclamation-triangle-fill me-1"></i> Error checking availability</span>';
                        submitBtn.disabled = false;
                    });
            }, 300);
        }
    });
});
</script>
@endsection