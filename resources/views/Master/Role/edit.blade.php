<!-- Edit Role Modal -->
<div class="modal fade text-left" id="editRoleModal{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="editRoleModalLabel{{ $role->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRoleModalLabel{{ $role->id }}">Edit Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('role.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="role_name{{ $role->id }}" class="form-label">Role Name</label>
                        <input type="text" id="role_name{{ $role->id }}" name="role_name" class="form-control" placeholder="Enter role name" required value="{{ old('role_name', $role->role_name) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="is_active{{ $role->id }}" class="form-label">Active Status</label>
                        <select name="is_active" id="is_active{{ $role->id }}" class="form-select" required>
                            <option value="">Select Active</option>
                            <option value="active" @if(old('is_active', $role->is_active) == 'active') selected @endif>Active</option>
                            <option value="inactive" @if(old('is_active', $role->is_active) == 'inactive') selected @endif>Inactive</option>
                        </select>
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
