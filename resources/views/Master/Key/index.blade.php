@extends('Master.layouts.app')
@section('title', 'Key Management')
@section('content')
  <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>{{ $title}}</h3>
                            <p class="text-subtitle text-muted">For user to check they list</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Key Management</li>
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
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createKeyModal">
                                <i class="bi bi-plus"></i> Create Key
                            </button>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Key Code</th>
                                        <th>Active</th>
                                        <th>Availability</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($keys as $key)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $key->name ?? '-' }}</td>
                                        <td>
                                            <span class="badge bg-{{ $key->is_active == 1 ? 'success' : 'danger' }}">
                                                {{ $key->is_active == 1 ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($key->locker)
                                                <span class="badge bg-secondary">Unavailable (Used by {{ $key->locker->locker_name ?? 'Locker '.$key->locker->locker_code }})</span>
                                            @else
                                                <span class="badge bg-success">Available</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editKeyModal{{ $key->id }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteKeyModal{{ $key->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @include('Master.Key.edit')
                                    @include('Master.Key.delete')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>

@include('Master.Key.create')

<script>
document.addEventListener('DOMContentLoaded', function() {
    let debounceTimer;
    
    document.addEventListener('input', function(e) {
        if (e.target && e.target.classList.contains('key-name-input')) {
            const input = e.target;
            const form = input.closest('form');
            const submitBtn = form.querySelector('button[type="submit"]');
            const feedbackDiv = form.querySelector('.key-name-feedback');
            const val = input.value.trim();
            const originalName = input.getAttribute('data-original-name');
            const keyId = input.getAttribute('data-key-id');

            clearTimeout(debounceTimer);

            if (val === '') {
                feedbackDiv.style.display = 'none';
                feedbackDiv.innerHTML = '';
                submitBtn.disabled = false;
                return;
            }

            // In edit mode: if the typed name is exactly the original name, it is available
            if (originalName && val.toLowerCase() === originalName.toLowerCase()) {
                feedbackDiv.style.display = 'block';
                feedbackDiv.innerHTML = '<span class="text-success"><i class="bi bi-check-circle-fill me-1"></i> Key code is available</span>';
                submitBtn.disabled = false;
                return;
            }

            feedbackDiv.style.display = 'block';
            feedbackDiv.innerHTML = '<span class="text-muted"><i class="spinner-border spinner-border-sm me-1" style="width: 1rem; height: 1rem;" role="status"></i> Checking availability...</span>';
            submitBtn.disabled = true;

            debounceTimer = setTimeout(() => {
                let url = "{{ route('key.check-name') }}?name=" + encodeURIComponent(val);
                if (keyId) {
                    url += "&id=" + encodeURIComponent(keyId);
                }

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data.available) {
                            feedbackDiv.innerHTML = '<span class="text-success"><i class="bi bi-check-circle-fill me-1"></i> Key code is available</span>';
                            submitBtn.disabled = false;
                        } else {
                            feedbackDiv.innerHTML = '<span class="text-danger"><i class="bi bi-x-circle-fill me-1"></i> Key code has already been taken</span>';
                            submitBtn.disabled = true;
                        }
                    })
                    .catch(err => {
                        console.error('Error checking key code availability:', err);
                        feedbackDiv.innerHTML = '<span class="text-warning"><i class="bi bi-exclamation-triangle-fill me-1"></i> Error checking availability</span>';
                        submitBtn.disabled = false;
                    });
            }, 300);
        }
    });
});
</script>
@endsection