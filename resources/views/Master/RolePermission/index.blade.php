@extends('Master.layouts.app')
@section('title', 'Role Permissions')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ $title }}</h3>
                <p class="text-subtitle text-muted">Configure menu access rights for each user role.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Role Permissions</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible show fade">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section class="section">
        <div class="row">
            <!-- Left Side: Roles List -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Roles</h4>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach($roles as $r)
                                <a href="{{ route('role-permission.index', ['role_id' => $r->id]) }}" 
                                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $selectedRole->id == $r->id ? 'active' : '' }}">
                                    <span>
                                        <i class="bi bi-shield-lock me-2"></i>
                                        {{ $r->role_name }}
                                    </span>
                                    <span class="badge {{ $selectedRole->id == $r->id ? 'bg-light text-dark' : 'bg-success' }}">
                                        {{ ucfirst($r->is_active) }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Menu Permissions Tree -->
            <div class="col-md-8">
                <form action="{{ route('role-permission.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role_id" value="{{ $selectedRole->id }}">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Menu Access for <strong>{{ $selectedRole->role_name }}</strong></h4>
                            <div>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="check-all">Check All</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="uncheck-all">Uncheck All</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Menu / Module</th>
                                            <th class="text-center" style="width: 150px;">Access Right</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($menus as $menu)
                                            <!-- Parent Menu -->
                                            <tr class="table-light">
                                                <td>
                                                    <strong>
                                                        @if($menu->icon)
                                                            <i class="{{ $menu->icon }} me-2"></i>
                                                        @endif
                                                        {{ $menu->name }}
                                                    </strong>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check d-inline-block">
                                                        <input class="form-check-input parent-checkbox" 
                                                               type="checkbox" 
                                                               name="menu_ids[]" 
                                                               value="{{ $menu->id }}"
                                                               data-id="{{ $menu->id }}"
                                                               {{ in_array($menu->id, $assignedMenuIds) ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Submenus -->
                                            @foreach($menu->submenus as $submenu)
                                                <tr>
                                                    <td class="ps-4">
                                                        <span class="text-muted me-2">—</span> {{ $submenu->name }}
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-check d-inline-block">
                                                            <input class="form-check-input submenu-checkbox" 
                                                                   type="checkbox" 
                                                                   name="menu_ids[]" 
                                                                   value="{{ $submenu->id }}"
                                                                   data-parent-id="{{ $menu->id }}"
                                                                   {{ in_array($submenu->id, $assignedMenuIds) ? 'checked' : '' }}>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<!-- JavaScript to handle checking/unchecking hierarchy -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const parentCheckboxes = document.querySelectorAll('.parent-checkbox');
    const submenuCheckboxes = document.querySelectorAll('.submenu-checkbox');
    
    // Toggle submenus when parent checked/unchecked
    parentCheckboxes.forEach(parent => {
        parent.addEventListener('change', function() {
            const parentId = this.getAttribute('data-id');
            const relatedSubmenus = document.querySelectorAll(`.submenu-checkbox[data-parent-id="${parentId}"]`);
            relatedSubmenus.forEach(sub => {
                sub.checked = this.checked;
            });
        });
    });

    // Toggle parent check when submenu is checked
    submenuCheckboxes.forEach(sub => {
        sub.addEventListener('change', function() {
            const parentId = this.getAttribute('data-parent-id');
            const parent = document.querySelector(`.parent-checkbox[data-id="${parentId}"]`);
            if (this.checked) {
                // If checking any submenu, the parent must be checked too
                parent.checked = true;
            } else {
                // If unchecking, see if there are any other submenus checked
                const siblingsChecked = document.querySelectorAll(`.submenu-checkbox[data-parent-id="${parentId}"]:checked`);
                if (siblingsChecked.length === 0) {
                    parent.checked = false;
                }
            }
        });
    });

    // Check All / Uncheck All buttons
    document.getElementById('check-all').addEventListener('click', function() {
        document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = true);
    });
    
    document.getElementById('uncheck-all').addEventListener('click', function() {
        document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
    });
});
</script>
@endsection
