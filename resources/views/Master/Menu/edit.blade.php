<!-- Edit Menu Modal -->
<div class="modal fade text-left" id="editMenuModal{{ $menu->id }}" tabindex="-1" role="dialog" aria-labelledby="editMenuModalLabel{{ $menu->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMenuModalLabel{{ $menu->id }}">Edit Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('menu.update', $menu->id) }}" method="POST" class="form form-horizontal">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <!-- Menu Name -->
                            <div class="col-md-4">
                                <label for="name{{ $menu->id }}">Menu Name</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="name{{ $menu->id }}" name="name" class="form-control" placeholder="Menu Name (e.g. Dashboard)" required value="{{ old('name', $menu->name) }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-menu-button"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Icon -->
                            <div class="col-md-4">
                                <label for="icon{{ $menu->id }}">Icon Class (e.g. bi bi-grid-fill)</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="icon{{ $menu->id }}" name="icon" class="form-control" placeholder="Bootstrap Icon Class (optional)" value="{{ old('icon', $menu->icon) }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Route -->
                            <div class="col-md-4">
                                <label for="route{{ $menu->id }}">Route Name (e.g. user.index)</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="route{{ $menu->id }}" name="route" class="form-control" placeholder="Laravel Route Name (optional)" value="{{ old('route', $menu->route) }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-link-45deg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Parent Menu -->
                            <div class="col-md-4">
                                <label for="parent_id{{ $menu->id }}">Parent Menu</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select name="parent_id" id="parent_id{{ $menu->id }}" class="form-select ps-5">
                                            <option value="">None (Top Level Menu)</option>
                                            @foreach($parentMenus as $parent)
                                                @if($parent->id != $menu->id)
                                                    <option value="{{ $parent->id }}" @if(old('parent_id', $menu->parent_id) == $parent->id) selected @endif>{{ $parent->name }}</option>
                                                @endif
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
                                <label for="order{{ $menu->id }}">Display Order</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="number" id="order{{ $menu->id }}" name="order" class="form-control" placeholder="Display Order (e.g. 1)" required value="{{ old('order', $menu->order) }}" min="0">
                                        <div class="form-control-icon">
                                            <i class="bi bi-sort-numeric-down"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Active Status -->
                            <div class="col-md-4">
                                <label for="is_active{{ $menu->id }}">Status</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select name="is_active" id="is_active{{ $menu->id }}" class="form-select ps-5" required>
                                            <option value="1" @if(old('is_active', $menu->is_active) == '1') selected @endif>Active</option>
                                            <option value="0" @if(old('is_active', $menu->is_active) == '0') selected @endif>Inactive</option>
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
