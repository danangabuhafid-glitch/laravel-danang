<!-- Create Key Modal -->
<div class="modal fade text-left" id="createKeyModal" tabindex="-1" role="dialog" aria-labelledby="createKeyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createKeyModalLabel">Create Key</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('key.store') }}" method="POST" class="form form-horizontal">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <!-- Key Code -->
                            <div class="col-md-4">
                                <label for="name">Key Code</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="name" name="name" class="form-control key-name-input" placeholder="Key Code" required value="{{ old('name') }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-shield-check"></i>
                                        </div>
                                    </div>
                                    <div class="key-name-feedback mt-1 small" style="display: none;"></div>
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
                                            <option value="1" @if(old('is_active') == '1') selected @endif>Active</option>
                                            <option value="0" @if(old('is_active') == '0') selected @endif>Inactive</option>
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
                    <button type="submit" class="btn btn-primary">Save Key</button>
                </div>
            </form>
        </div>
    </div>
</div>