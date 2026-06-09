<!-- Delete Key Modal -->
<div class="modal fade text-left" id="deleteKeyModal{{ $key->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteKeyModalLabel{{ $key->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteKeyModalLabel{{ $key->id }}">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('key.destroy', $key->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Are you sure you want to delete key <strong>{{ $key->name }}</strong>?</p>
                    <p class="text-danger"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete Key</button>
                </div>
            </form>
        </div>
    </div>
</div>
