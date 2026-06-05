<!-- Edit User Modal -->
<div class="modal fade text-left" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="name{{ $user->id }}" class="form-label">Name</label>
                        <input type="text" id="name{{ $user->id }}" name="name" class="form-control" placeholder="Enter full name" required value="{{ old('name', $user->name) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="username{{ $user->id }}" class="form-label">Username</label>
                        <input type="text" id="username{{ $user->id }}" name="username" class="form-control" placeholder="Enter username" required value="{{ old('username', $user->username) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email{{ $user->id }}" class="form-label">Email</label>
                        <input type="email" id="email{{ $user->id }}" name="email" class="form-control" placeholder="Enter email address" required value="{{ old('email', $user->email) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="role_id{{ $user->id }}" class="form-label">Role</label>
                        <select name="role_id" id="role_id{{ $user->id }}" class="form-select" required>
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" @if(old('role_id', $user->role_id) == $role->id) selected @endif>{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password{{ $user->id }}" class="form-label">Password</label>
                        <input type="password" id="password{{ $user->id }}" name="password" class="form-control" placeholder="Enter new password (optional)">
                        <small class="text-muted">Leave blank if you don't want to change the password.</small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password_confirmation{{ $user->id }}" class="form-label">Confirm Password</label>
                        <input type="password" id="password_confirmation{{ $user->id }}" name="password_confirmation" class="form-control" placeholder="Confirm new password">
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