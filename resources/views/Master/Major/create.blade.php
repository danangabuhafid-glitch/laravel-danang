<!-- Create Major Modal -->
<div class="modal fade text-left" id="createMajorModal" tabindex="-1" role="dialog" aria-labelledby="createMajorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createMajorModalLabel">Create Major</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('major.store') }}" method="POST" class="form form-horizontal">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <!-- Major Name -->
                            <div class="col-md-4">
                                <label for="name">Major Name</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Major Name" required value="{{ old('name') }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-shield-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Active Status -->
                            <div class="col-md-4">
                                <label for="is_active">Active</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select name="is_active" id="is_active" class="form-select ps-5" required>
                                            <option value="">Select Active Status</option>
                                            <option value="1" @if(old('is_active') === '1') selected @endif>Active</option>
                                            <option value="0" @if(old('is_active') === '0') selected @endif>Inactive</option>
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
                    <button type="submit" class="btn btn-primary">Save Major</button>
                </div>
            </form>
        </div>
    </div>
</div>
