<!-- Delete Instructor Modal -->
<div class="modal fade text-left" id="deleteInstructorModal{{ $instructor->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteInstructorModalLabel{{ $instructor->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title white" id="deleteInstructorModalLabel{{ $instructor->id }}">Delete Instructor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('instructor.destroy', $instructor->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    Are you sure you want to delete the instructor <strong>{{ $instructor->instructor_name }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger ml-1">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
