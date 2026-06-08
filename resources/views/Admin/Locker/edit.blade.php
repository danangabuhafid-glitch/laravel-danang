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
                                        <input type="text" id="locker_code{{ $locker->id }}" name="locker_code" class="form-control locker-code-input" placeholder="Locker Code" required value="{{ old('locker_code', $locker->locker_code) }}" data-original-code="{{ $locker->locker_code }}" data-locker-id="{{ $locker->id }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-box"></i>
                                        </div>
                                    </div>
                                    <div class="locker-code-feedback mt-1 small" style="display: none;"></div>
                                </div>
                            </div>

                            <!-- Locker Name -->
                            <div class="col-md-4">
                                <label for="locker_name{{ $locker->id }}">Owner Name</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="locker_name{{ $locker->id }}" name="locker_name" class="form-control" placeholder="Locker Name" required value="{{ old('locker_name', $locker->locker_name) }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-box"></i>
                                        </div>
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
                                <label for="major{{ $locker->id }}">Major</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select name="major" id="major{{ $locker->id }}" class="form-select ps-5" required>
                                            <option value="">Select Major</option>
                                            <option value="Web Programming" @if(old('major', $locker->major) == 'Web Programming') selected @endif>Web Programming</option>
                                            <option value="Multimedia" @if(old('major', $locker->major) == 'Multimedia') selected @endif>Multimedia</option>
                                            <option value="Teknik Jaringan" @if(old('major', $locker->major) == 'Teknik Jaringan') selected @endif>Teknik Jaringan</option>
                                        </select>
                                        <div class="form-control-icon">
                                            <i class="bi bi-bookmark"></i>
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