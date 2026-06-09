<!-- Create Locker Modal -->
<div class="modal fade text-left" id="createLockerModal" tabindex="-1" role="dialog" aria-labelledby="createLockerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLockerModalLabel">Create New Locker</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('locker.store') }}" method="POST" class="form form-horizontal">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <!-- Locker Code -->
                            <div class="col-md-4">
                                <label for="locker_code">Locker Code</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="locker_code" name="locker_code" class="form-control locker-code-input" placeholder="Select a key to generate code" readonly required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-box"></i>
                                        </div>
                                    </div>
                                    <div class="locker-code-feedback mt-1 small" style="display: none;"></div>
                                </div>
                            </div>

                            <!-- Owner / Student -->
                            <div class="col-md-4">
                                <label for="student_name_display_create">Owner (Student)</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="hidden" name="student_id" id="student_id_create" value="">
                                        <input type="text" id="student_name_display_create" class="form-control" placeholder="Click choose to select student" readonly style="background-color: #f2f7ff; cursor: default;">
                                        <button class="btn btn-primary" type="button" onclick="openChooseStudentModal('#student_id_create', '#student_name_display_create')">
                                            <i class="bi bi-search"></i> Choose
                                        </button>
                                        <button class="btn btn-outline-danger" type="button" onclick="clearStudentSelection('#student_id_create', '#student_name_display_create')">
                                            <i class="bi bi-x"></i> Clear
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Locker Description -->
                            <div class="col-md-4">
                                <label for="locker_description">Locker Description</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="locker_description" name="locker_description" class="form-control" placeholder="Locker Description">
                                        <div class="form-control-icon">
                                            <i class="bi bi-box"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Major -->
                            <div class="col-md-4">
                                <label for="major_create_select">Major</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="hidden" name="major" id="major_create_hidden" value="">
                                        <select name="major_select" id="major_create_select" class="form-select ps-5" required @if(old('student_id')) disabled @endif style="background-color: #f2f7ff; cursor: default;">
                                            <option value="">Select Student to detect Major</option>
                                            @foreach($majors as $majorItem)
                                                <option value="{{ $majorItem->name }}">{{ $majorItem->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-control-icon">
                                            <i class="bi bi-bookmark"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Key -->
                            <div class="col-md-4">
                                <label for="key_id">Key</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select name="key_id" id="key_id" class="form-select ps-5" required>
                                            <option value="">Select Key</option>
                                            @foreach($keys as $keyItem)
                                                <option value="{{ $keyItem->id }}" data-name="{{ $keyItem->name }}">{{ $keyItem->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-control-icon">
                                            <i class="bi bi-key"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Locker Status -->
                            <div class="col-md-4">
                                <label for="locker_status">Locker Status</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select name="locker_status" id="locker_status" class="form-select ps-5" required>
                                            <option value="">Select Locker Status</option>
                                            <option value="Available">Available</option>
                                            <option value="Unavailable">Unavailable</option>
                                            <option value="Damaged">Damaged</option>
                                            <option value="Missing">Missing</option>
                                        </select>
                                        <div class="form-control-icon">
                                            <i class="bi bi-toggle-on"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Batch -->
                            <div class="col-md-4">
                                <label for="batch">Batch</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select name="batch" id="batch" class="form-select ps-5" required>
                                            <option value="">Select Batch</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                        <div class="form-control-icon">
                                            <i class="bi bi-layers"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Locker</button>
                </div>
            </form>
        </div>
    </div>
</div>