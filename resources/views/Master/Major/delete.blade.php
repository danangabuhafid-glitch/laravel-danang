<!-- Delete Major Modal -->
<div class="modal fade text-left" id="deleteMajorModal{{ $major->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteMajorModalLabel{{ $major->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title white" id="deleteMajorModalLabel{{ $major->id }}">Delete Major</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('major.destroy', $major->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    Are you sure you want to delete the major <strong>{{ $major->name }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger ml-1">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
