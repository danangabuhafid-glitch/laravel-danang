<!-- Delete Menu Modal -->
<div class="modal fade text-left" id="deleteMenuModal{{ $menu->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteMenuModalLabel{{ $menu->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMenuModalLabel{{ $menu->id }}">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('menu.destroy', $menu->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Are you sure you want to delete menu <strong>{{ $menu->name }}</strong>?</p>
                    @if($menu->parent_id === null && $menu->submenus->isNotEmpty())
                        <p class="text-danger"><i class="bi bi-exclamation-triangle-fill"></i> <strong>Warning:</strong> Deleting this parent menu will also delete all of its submenus ({{ $menu->submenus->pluck('name')->implode(', ') }}).</p>
                    @endif
                    <p class="text-danger"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete Menu</button>
                </div>
            </form>
        </div>
    </div>
</div>
