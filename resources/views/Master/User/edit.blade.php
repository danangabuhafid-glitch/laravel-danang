<!-- Edit User Modal -->
<div class="modal fade text-left" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.update', $user->id) }}" method="POST" class="form form-horizontal">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-4">
                                <label for="name{{ $user->id }}">Name</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="name{{ $user->id }}" name="name" class="form-control" placeholder="Name" required value="{{ old('name', $user->name) }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Username -->
                            <div class="col-md-4">
                                <label for="username{{ $user->id }}">Username</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="username{{ $user->id }}" name="username" class="form-control" placeholder="Username" required value="{{ old('username', $user->username) }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-person-badge"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-4">
                                <label for="email{{ $user->id }}">Email</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="email" id="email{{ $user->id }}" name="email" class="form-control" placeholder="Email" required value="{{ old('email', $user->email) }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-envelope"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Role -->
                            <div class="col-md-4">
                                <label for="role_id{{ $user->id }}">Role</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select name="role_id" id="role_id{{ $user->id }}" class="form-select ps-5" required>
                                            <option value="">Select Role</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" @if(old('role_id', $user->role_id) == $role->id) selected @endif>{{ $role->role_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-control-icon">
                                            <i class="bi bi-shield"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="col-md-4">
                                <label for="password{{ $user->id }}">Password</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left mb-1">
                                    <div class="position-relative">
                                        <input type="password" id="password{{ $user->id }}" name="password" class="form-control" placeholder="Password (Optional)">
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted d-block mb-3">Leave blank if you don't want to change the password.</small>
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-4">
                                <label for="password_confirmation{{ $user->id }}">Confirm Password</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="password" id="password_confirmation{{ $user->id }}" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock-fill"></i>
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