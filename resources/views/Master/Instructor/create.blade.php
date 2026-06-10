<!-- Create Instructor Modal -->
<div class="modal fade text-left" id="createInstructorModal" tabindex="-1" role="dialog" aria-labelledby="createInstructorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createInstructorModalLabel">Create Instructor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('instructor.store') }}" method="POST" class="form form-horizontal">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <!-- Instructor Name -->
                            <div class="col-md-4">
                                <label for="instructor_name">Instructor Name</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="instructor_name" name="instructor_name" class="form-control" placeholder="Instructor Name" required value="{{ old('instructor_name') }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Major -->
                            <div class="col-md-4">
                                <label for="major_id">Major</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select name="major_id" id="major_id" class="form-select ps-5" required>
                                            <option value="">Select Major</option>
                                            @foreach($majors as $major)
                                                <option value="{{ $major->id }}" @if(old('major_id') == $major->id) selected @endif>{{ $major->name }}</option>
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
                                <label for="phone">Phone</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone Number" value="{{ old('phone') }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-telephone"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-4">
                                <label for="is_active">Status</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select name="is_active" id="is_active" class="form-select ps-5" required>
                                            <option value="">Select Status</option>
                                            <option value="1" @if(old('is_active') === '1') selected @endif>Active</option>
                                            <option value="0" @if(old('is_active') === '0') selected @endif>Inactive</option>
                                        </select>
                                        <div class="form-control-icon">
                                            <i class="bi bi-toggle-on"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Username -->
                            <div class="col-md-4">
                                <label for="username">Username</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-4">
                                <label for="email">Email</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" value="{{ old('email') }}" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-envelope"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="col-md-4">
                                <label for="password">Password</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Repeat Password -->
                            <div class="col-md-4">
                                <label for="password_confirmation">Repeat Password</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Repeat Password" value="{{ old('password_confirmation') }}" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Instructor</button>
                </div>
            </form>
        </div>
    </div>
</div>
