<!-- Edit Key Modal -->
<div class="modal fade text-left" id="editKeyModal{{ $key->id }}" tabindex="-1" role="dialog" aria-labelledby="editKeyModalLabel{{ $key->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKeyModalLabel{{ $key->id }}">Edit Key</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('key.update', $key->id) }}" method="POST" class="form form-horizontal">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <!-- Key Code -->
                            <div class="col-md-4">
                                <label for="name{{ $key->id }}">Key Code</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="name{{ $key->id }}" name="name" class="form-control key-name-input" placeholder="Key Code" required value="{{ old('name', $key->name) }}" data-original-name="{{ $key->name }}" data-key-id="{{ $key->id }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-shield-check"></i>
                                        </div>
                                    </div>
                                    <div class="key-name-feedback mt-1 small" style="display: none;"></div>
                                </div>
                            </div>

                            <!-- Active Status -->
                            <div class="col-md-4">
                                <label for="is_active{{ $key->id }}">Active</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select name="is_active" id="is_active{{ $key->id }}" class="form-select ps-5" required>
                                            <option value="">Select Active Status</option>
                                            <option value="1" @if(old('is_active', $key->is_active) == '1') selected @endif>Active</option>
                                            <option value="0" @if(old('is_active', $key->is_active) == '0') selected @endif>Inactive</option>
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
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
