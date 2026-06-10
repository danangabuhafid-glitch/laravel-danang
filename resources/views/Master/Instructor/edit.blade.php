<!-- Edit Instructor Modal -->
<div class="modal fade text-left" id="editInstructorModal{{ $instructor->id }}" tabindex="-1" role="dialog" aria-labelledby="editInstructorModalLabel{{ $instructor->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editInstructorModalLabel{{ $instructor->id }}">Edit Instructor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('instructor.update', $instructor->id) }}" method="POST" class="form form-horizontal">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <!-- Instructor Name -->
                            <div class="col-md-4">
                                <label for="instructor_name{{ $instructor->id }}">Instructor Name</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="instructor_name{{ $instructor->id }}" name="instructor_name" class="form-control" placeholder="Instructor Name" required value="{{ old('instructor_name', $instructor->instructor_name) }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Major -->
                            <div class="col-md-4">
                                <label for="major_id{{ $instructor->id }}">Major</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select name="major_id" id="major_id{{ $instructor->id }}" class="form-select ps-5" required>
                                            <option value="">Select Major</option>
                                            @foreach($majors as $major)
                                                <option value="{{ $major->id }}" @if(old('major_id', $instructor->major_id) == $major->id) selected @endif>{{ $major->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-control-icon">
                                            <i class="bi bi-bookmark"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-md-4">
                                <label for="phone{{ $instructor->id }}">Phone</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="phone{{ $instructor->id }}" name="phone" class="form-control" placeholder="Phone Number" value="{{ old('phone', $instructor->phone) }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-telephone"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-4">
                                <label for="is_active{{ $instructor->id }}">Status</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select name="is_active" id="is_active{{ $instructor->id }}" class="form-select ps-5" required>
                                            <option value="">Select Status</option>
                                            <option value="1" @if(old('is_active', $instructor->is_active) == '1') selected @endif>Active</option>
                                            <option value="0" @if(old('is_active', $instructor->is_active) == '0') selected @endif>Inactive</option>
                                        </select>
                                        <div class="form-control-icon">
                                            <i class="bi bi-toggle-on"></i>
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
