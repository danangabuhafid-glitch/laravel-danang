<!-- Create Menu Modal -->
<div class="modal fade text-left" id="createMenuModal" tabindex="-1" role="dialog" aria-labelledby="createMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createMenuModalLabel">Create Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('menu.store') }}" method="POST" class="form form-horizontal">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <!-- Menu Name -->
                            <div class="col-md-4">
                                <label for="name">Menu Name</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Menu Name (e.g. Dashboard)" required value="{{ old('name') }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-menu-button"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Icon -->
                            <div class="col-md-4">
                                <label for="icon">Icon Class (e.g. bi bi-grid-fill)</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="icon" name="icon" class="form-control" placeholder="Bootstrap Icon Class (optional)" value="{{ old('icon') }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Route -->
                            <div class="col-md-4">
                                <label for="route">Route Name (e.g. user.index)</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="route" name="route" class="form-control" placeholder="Laravel Route Name (optional)" value="{{ old('route') }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-link-45deg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Parent Menu -->
                            <div class="col-md-4">
                                <label for="parent_id">Parent Menu</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select name="parent_id" id="parent_id" class="form-select ps-5">
                                            <option value="">None (Top Level Menu)</option>
                                            @foreach($parentMenus as $parent)
                                                <option value="{{ $parent->id }}" @if(old('parent_id') == $parent->id) selected @endif>{{ $parent->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-control-icon">
                                            <i class="bi bi-folder2-open"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Order -->
                            <div class="col-md-4">
                                <label for="order">Display Order</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="number" id="order" name="order" class="form-control" placeholder="Display Order (e.g. 1)" required value="{{ old('order', 0) }}" min="0">
                                        <div class="form-control-icon">
                                            <i class="bi bi-sort-numeric-down"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Active Status -->
                            <div class="col-md-4">
                                <label for="is_active">Status</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select name="is_active" id="is_active" class="form-select ps-5" required>
                                            <option value="1" @if(old('is_active', '1') == '1') selected @endif>Active</option>
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
                    <button type="submit" class="btn btn-primary">Save Menu</button>
                </div>
            </form>
        </div>
    </div>
</div>
