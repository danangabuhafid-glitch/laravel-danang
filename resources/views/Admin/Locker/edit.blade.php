<!-- Edit Locker Modal -->
<div class="modal fade text-left" id="editLockerModal{{ $locker->id }}" tabindex="-1" role="dialog" aria-labelledby="editLockerModalLabel{{ $locker->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLockerModalLabel{{ $locker->id }}">Edit Locker</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('locker.update', $locker->id) }}" method="POST" class="form form-horizontal">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <!-- Locker Code -->
                            <div class="col-md-4">
                                <label for="locker_code{{ $locker->id }}">Locker Code</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="locker_code{{ $locker->id }}" name="locker_code" class="form-control locker-code-input" placeholder="Select a key to generate code" readonly required value="{{ old('locker_code', $locker->locker_code) }}" data-original-code="{{ $locker->locker_code }}" data-locker-id="{{ $locker->id }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-box"></i>
                                        </div>
                                    </div>
                                    <div class="locker-code-feedback mt-1 small" style="display: none;"></div>
                                </div>
                            </div>

                            <!-- Owner / Student -->
                            <div class="col-md-4">
                                <label for="student_name_display_edit{{ $locker->id }}">Owner (Student)</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="hidden" name="student_id" id="student_id_edit{{ $locker->id }}" value="{{ $locker->student_id }}">
                                        <input type="text" id="student_name_display_edit{{ $locker->id }}" class="form-control" placeholder="Click choose to select student" readonly style="background-color: #f2f7ff; cursor: default;" value="{{ $locker->student->student_name ?? '' }}">
                                        <button class="btn btn-primary" type="button" onclick="openChooseStudentModal('#student_id_edit{{ $locker->id }}', '#student_name_display_edit{{ $locker->id }}')">
                                            <i class="bi bi-search"></i> Choose
                                        </button>
                                        <button class="btn btn-outline-danger" type="button" onclick="clearStudentSelection('#student_id_edit{{ $locker->id }}', '#student_name_display_edit{{ $locker->id }}')">
                                            <i class="bi bi-x"></i> Clear
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Locker Description -->
                            <div class="col-md-4">
                                <label for="locker_description{{ $locker->id }}">Locker Description</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="locker_description{{ $locker->id }}" name="locker_description" class="form-control" placeholder="Locker Description" value="{{ old('locker_description', $locker->locker_description) }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-box"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <!-- Major -->
                             <div class="col-md-4">
                                 <label for="major_select{{ $locker->id }}">Major</label>
                             </div>
                             <div class="col-md-8">
                                 <div class="form-group has-icon-left">
                                     <div class="position-relative">
                                         <input type="hidden" name="major" id="major_edit_hidden{{ $locker->id }}" value="{{ old('major', $locker->major) }}">
                                         <select name="major_select" id="major_select{{ $locker->id }}" class="form-select ps-5" required @if($locker->student_id) disabled @endif style="background-color: #f2f7ff; cursor: default;">
                                             <option value="">Select Student to detect Major</option>
                                             @foreach($majors as $majorItem)
                                                 <option value="{{ $majorItem->name }}" @if(old('major', $locker->major) == $majorItem->name) selected @endif>{{ $majorItem->name }}</option>
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
                                 <label for="key_id{{ $locker->id }}">Key</label>
                             </div>
                             <div class="col-md-8">
                                 <div class="form-group has-icon-left">
                                     <div class="position-relative">
                                         <select name="key_id" id="key_id{{ $locker->id }}" class="form-select ps-5" required>
                                             <option value="">Select Key</option>
                                             @foreach($keys as $keyItem)
                                                 <option value="{{ $keyItem->id }}" data-name="{{ $keyItem->name }}" @if(old('key_id', $locker->key_id) == $keyItem->id) selected @endif>{{ $keyItem->name }}</option>
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
                                <label for="locker_status{{ $locker->id }}">Locker Status</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select name="locker_status" id="locker_status{{ $locker->id }}" class="form-select ps-5" required>
                                            <option value="">Select Locker Status</option>
                                            <option value="Available" @if(old('locker_status', $locker->locker_status) == 'Available') selected @endif>Available</option>
                                            <option value="Unavailable" @if(old('locker_status', $locker->locker_status) == 'Unavailable') selected @endif>Unavailable</option>
                                            <option value="Damaged" @if(old('locker_status', $locker->locker_status) == 'Damaged') selected @endif>Damaged</option>
                                            <option value="Missing" @if(old('locker_status', $locker->locker_status) == 'Missing') selected @endif>Missing</option>
                                        </select>
                                        <div class="form-control-icon">
                                            <i class="bi bi-toggle-on"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Batch -->
                            <div class="col-md-4">
                                <label for="batch{{ $locker->id }}">Batch</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select name="batch" id="batch{{ $locker->id }}" class="form-select ps-5" required>
                                            <option value="">Select Batch</option>
                                            <option value="1" @if(old('batch', $locker->batch) == '1') selected @endif>1</option>
                                            <option value="2" @if(old('batch', $locker->batch) == '2') selected @endif>2</option>
                                            <option value="3" @if(old('batch', $locker->batch) == '3') selected @endif>3</option>
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
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>