<!-- Delete Role Modal -->
<div class="modal fade text-left" id="deleteRoleModal{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteRoleModalLabel{{ $role->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRoleModalLabel{{ $role->id }}">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('role.destroy', $role->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Are you sure you want to delete role <strong>{{ $role->role_name }}</strong>?</p>
                    <p class="text-danger"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete Role</button>
                </div>
            </form>
        </div>
    </div>
</div>
