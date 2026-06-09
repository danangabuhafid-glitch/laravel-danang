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
                            <th>Key</th>
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
                            <td>{{ $locker->student->student_name ?? $locker->locker_name ?? '-' }}</td>
                            <td>{{ $locker->locker_description }}</td>
                            <td>{{ $locker->major ?? 'All' }}</td>
                            <td>{{ $locker->key->name ?? '-' }}</td>
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

<!-- Choose Student Modal -->
<div class="modal fade text-left" id="chooseStudentModal" tabindex="-1" role="dialog" aria-labelledby="chooseStudentModalLabel" aria-hidden="true" style="z-index: 1080;" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content border border-primary" style="box-shadow: 0 10px 30px rgba(0,0,0,0.25);">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title white" id="chooseStudentModalLabel">Select Student</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" id="searchStudentInput" class="form-control" placeholder="Search student by name or major...">
                </div>
                <div class="table-responsive" style="max-height: 300px;">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Major</th>
                                <th style="width: 80px;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="studentSearchList">
                            @foreach($students as $studentItem)
                            <tr class="student-row" data-id="{{ $studentItem->id }}" data-name="{{ $studentItem->student_name }}" data-major="{{ $studentItem->major->name ?? '-' }}">
                                <td>{{ $studentItem->student_name }}</td>
                                <td>{{ $studentItem->major->name ?? '-' }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary btn-select-student" data-id="{{ $studentItem->id }}" data-name="{{ $studentItem->student_name }}" data-major="{{ $studentItem->major->name ?? '' }}">Choose</button>
                                </td>
                            </tr>
                            @endforeach
                            @if(count($students) === 0)
                            <tr>
                                <td colspan="3" class="text-center">No active students found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    let targetStudentIdInput = null;
    let targetStudentNameInput = null;
    let chooseStudentModalObj = null;

    window.openChooseStudentModal = function(idSelector, nameSelector) {
        targetStudentIdInput = document.querySelector(idSelector);
        targetStudentNameInput = document.querySelector(nameSelector);
        
        // Move the modal to the body so it sits outside any restricted stacking contexts
        const modalEl = document.getElementById('chooseStudentModal');
        if (modalEl && modalEl.parentNode !== document.body) {
            document.body.appendChild(modalEl);
        }
        
        // Reset search input and show all rows
        const searchInput = document.getElementById('searchStudentInput');
        if (searchInput) {
            searchInput.value = '';
        }
        document.querySelectorAll('.student-row').forEach(row => {
            row.style.display = '';
        });

        if (!chooseStudentModalObj) {
            chooseStudentModalObj = new bootstrap.Modal(document.getElementById('chooseStudentModal'));
        }
        chooseStudentModalObj.show();
    };

    window.clearStudentSelection = function(idSelector, nameSelector) {
        document.querySelector(idSelector).value = '';
        document.querySelector(nameSelector).value = '';
        
        const form = document.querySelector(idSelector).closest('form');
        if (form) {
            const majorSelect = form.querySelector('select[name="major_select"]');
            const majorHidden = form.querySelector('input[name="major"]');
            if (majorSelect) {
                majorSelect.disabled = false;
                majorSelect.selectedIndex = 0;
            }
            if (majorHidden) {
                majorHidden.value = '';
            }
        }
    };

    // Sync manual major selection to hidden input if student is not chosen
    document.addEventListener('change', function(e) {
        if (e.target && e.target.name === 'major_select') {
            const form = e.target.closest('form');
            if (form) {
                const majorHidden = form.querySelector('input[name="major"]');
                if (majorHidden) {
                    majorHidden.value = e.target.value;
                }
            }
        }
    });

    // Handle student selection
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('btn-select-student')) {
            const id = e.target.getAttribute('data-id');
            const name = e.target.getAttribute('data-name');
            const major = e.target.getAttribute('data-major');
            
            if (targetStudentIdInput && targetStudentNameInput) {
                targetStudentIdInput.value = id;
                targetStudentNameInput.value = name;
                
                // Automatically find, select, and disable the corresponding major in the active form
                const form = targetStudentIdInput.closest('form');
                if (form) {
                    const majorSelect = form.querySelector('select[name="major_select"]');
                    const majorHidden = form.querySelector('input[name="major"]');
                    if (majorSelect && major) {
                        for (let i = 0; i < majorSelect.options.length; i++) {
                            if (majorSelect.options[i].value.toLowerCase() === major.toLowerCase()) {
                                majorSelect.selectedIndex = i;
                                majorSelect.disabled = true;
                                if (majorHidden) {
                                    majorHidden.value = majorSelect.options[i].value;
                                }
                                break;
                            }
                        }
                    }
                }
            }
            
            if (chooseStudentModalObj) {
                chooseStudentModalObj.hide();
            }
        }
    });

    // Handle student search filtering
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchStudentInput');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const filter = this.value.toLowerCase();
                document.querySelectorAll('.student-row').forEach(row => {
                    const name = row.getAttribute('data-name').toLowerCase();
                    const major = row.getAttribute('data-major').toLowerCase();
                    if (name.includes(filter) || major.includes(filter)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });

document.addEventListener('DOMContentLoaded', function() {
    // Sync locker code when key is selected
    document.addEventListener('change', function(e) {
        if (e.target && (e.target.id === 'key_id' || e.target.id.startsWith('key_id'))) {
            const select = e.target;
            const form = select.closest('form');
            const codeInput = form.querySelector('.locker-code-input');
            if (codeInput) {
                const selectedOption = select.options[select.selectedIndex];
                const keyName = selectedOption ? selectedOption.getAttribute('data-name') : '';
                codeInput.value = keyName || '';
                // Trigger input validation check
                codeInput.dispatchEvent(new Event('input', { bubbles: true }));
            }
        }
    });

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