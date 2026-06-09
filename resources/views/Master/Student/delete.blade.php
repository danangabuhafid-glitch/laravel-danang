<!-- Delete Student Modal -->
<div class="modal fade text-left" id="deleteStudentModal{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteStudentModalLabel{{ $student->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title white" id="deleteStudentModalLabel{{ $student->id }}">Delete Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('student.destroy', $student->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    Are you sure you want to delete the student <strong>{{ $student->student_name }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger ml-1">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
