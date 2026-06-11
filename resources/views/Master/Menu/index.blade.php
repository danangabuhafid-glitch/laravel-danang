@extends('Master.layouts.app')
@section('title', 'Menu Management')
@section('content')
  <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $title }}</h3>
                    <p class="text-subtitle text-muted">Manage system menus, parent structures, icons, routes, and order</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Menu Management</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible show fade">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible show fade">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createMenuModal">
                        <i class="bi bi-plus"></i> Create Menu
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Menu Name</th>
                                <th>Icon</th>
                                <th>Route Name</th>
                                <th>Parent Menu</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menus as $menu)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($menu->parent_id)
                                        <span class="ps-3 text-muted"><i class="bi bi-arrow-return-right me-1"></i> {{ $menu->name }}</span>
                                    @else
                                        <strong>{{ $menu->name }}</strong>
                                    @endif
                                </td>
                                <td>
                                    @if($menu->icon)
                                        <span class="badge bg-light text-dark"><i class="{{ $menu->icon }} me-1"></i> {{ $menu->icon }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($menu->route)
                                        <code>{{ $menu->route }}</code>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($menu->parent)
                                        <span class="badge bg-info">{{ $menu->parent->name }}</span>
                                    @else
                                        <span class="badge bg-secondary">Top Level</span>
                                    @endif
                                </td>
                                <td>{{ $menu->order }}</td>
                                <td>
                                    <span class="badge bg-{{ $menu->is_active ? 'success' : 'danger' }}">
                                        {{ $menu->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editMenuModal{{ $menu->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteMenuModal{{ $menu->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @include('Master.Menu.edit')
                            @include('Master.Menu.delete')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

@include('Master.Menu.create')
@endsection
