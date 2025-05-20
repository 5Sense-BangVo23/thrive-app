<style>
    .category-admin-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
    }

    .category-admin-title {
        font-size: 28px;
        margin-bottom: 24px;
        color: #e91e63;
        font-weight: bold;
        text-align: center;
    }

    .category-btn-add {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 18px;
        background-color: #9c27b0;
        color: #fff;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: background-color 0.2s ease;
    }

    .category-btn-add:hover {
        background-color: #7b1fa2;
    }

    .category-alert-success {
        padding: 12px;
        background-color: #e8f5e9;
        color: #2e7d32;
        margin-bottom: 20px;
        border-radius: 6px;
        border: 1px solid #c8e6c9;
    }

    .category-no-items {
        text-align: center;
        color: #999;
        font-style: italic;
        margin-top: 20px;
    }

    .category-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        table-layout: fixed;
    }

    .category-table thead {
        background-color: #fce4ec;
    }

    .category-table th,
    .category-table td {
        padding: 12px;
        font-size: 14px;
        border-bottom: 1px solid #eee;
        color: #333;
        vertical-align: middle;
        text-align: left;
        word-wrap: break-word;
        word-break: break-word;
    }

    .category-table tbody tr:hover {
        background-color: #f9f9f9;
    }

    .category-action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

   .category-pagination {
        margin-top: 24px;
        text-align: center;
        font-family: Arial, sans-serif;
    }

    .category-pagination .pagination {
        display: inline-flex;
        list-style: none;
        padding: 0;
        border-radius: 6px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .category-pagination .pagination li {
        margin: 0 4px;
    }

    .category-pagination .pagination li a,
    .category-pagination .pagination li span {
        display: block;
        padding: 8px 14px;
        color: #9c27b0;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 6px;
        text-decoration: none;
        transition: background-color 0.3s, color 0.3s;
        min-width: 36px;
        text-align: center;
        font-weight: 500;
    }

    .category-pagination .pagination li a:hover {
        background-color: #9c27b0;
        color: #fff;
    }

    .category-pagination .pagination li.active span {
        background-color: #9c27b0;
        color: white;
        border-color: #9c27b0;
        cursor: default;
    }

    .category-pagination .pagination li.disabled span {
        color: #ccc;
        cursor: not-allowed;
    }

    .status-icon {
        font-size: 1.3rem;
        margin: 0 4px;
        transition: transform 0.2s ease;
        cursor: default;
    }

    .status-icon:hover {
        transform: scale(1.2);
    }

    /* Specific colors for each status */
    .status-draft {
        color: #6c757d; /* Gray */
    }

    .status-published {
        color: #28a745; /* Green */
    }

    .status-archived {
        color: #6c757d; /* Dim Gray */
    }

    .status-unknown {
        color: #ffc107; /* Yellow/Warning */
    }

    .published-status-header {
        font-weight: 700;
        text-transform: uppercase;
        text-align: center;
    }
</style>


@extends('admin.layout.home')
@section('title', 'Category list')
@section('content')
<div class="category-admin-container">
    <h2 class="category-admin-title">Category List</h2>

    @include('admin.layout.search', [
            'route' => route('admin.categories.search'),
            'cancelRoute' => route('admin.categories.list')
    ])

    @include('admin.layout.visibility-fields', [
            'fields' => $fields,
            'visibleFields' => $visibleFields,
            'route' => route('admin.categories.visibility')
    ])

    <a href="{{ route('admin.categories.create') }}" class="category-btn-add">+ Add New Category</a>

    @if(session('success'))
        @include('admin.components.messages.alert-message', [
            'type' => 'success',
            'message' => session('success'),
            'time' => session('success_time')
        ])
    @endif

    @if(empty($categories) || count($categories) == 0)
      <div class="category-no-items">No categories available.</div>
    @else
      <table class="category-table">
            <thead>
                <tr>
                    @if (in_array('id', $visibleFields))
                        <th>#</th>
                    @endif

                    @if (in_array('name', $visibleFields))
                        <th>Category Name</th>
                    @endif

                    @if (in_array('description', $visibleFields))
                        <th>Description</th>
                    @endif

                   <th class="published-status-header">Published Status <i class="fas fa-star" style="color:#888;"></i></th>

                    @if (in_array('created_at', $visibleFields))
                        <th>Created At</th>
                    @endif
                     @if (in_array('updated_at', $visibleFields))
                        <th>Updated At</th>
                    @endif
                     <th>Actions</th> {{-- Actions luôn hiện --}}
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        @if (in_array('id', $visibleFields))
                            <td>{{ $category->id ?? '-' }}</td>
                        @endif

                        @if (in_array('name', $visibleFields))
                            <td>{{ $category->name ?? '-' }}</td>
                        @endif

                        @if (in_array('description', $visibleFields))
                            <td>{{ $category->description ?? '-' }}</td>
                        @endif

                        <td class="text-center">
                            @php
                                $status = $category->publish_status ?? 'unknown';
                            @endphp

                            

                            @switch($status)
                                @case('draft')
                                    <i class="fas fa-pencil-alt status-icon status-draft" title="Draft"></i>
                                    @break

                                @case('published')
                                    <i class="fas fa-check-circle status-icon status-published" title="Published"></i>
                                    @break

                                @case('archived')
                                    <i class="fas fa-archive status-icon status-archived" title="Archived"></i>
                                    @break

                                @default
                                    <i class="fas fa-question-circle status-icon status-unknown" title="Unknown"></i>
                            @endswitch
                        </td>

                        @if (in_array('created_at', $visibleFields))
                            <td>{{ $category->created_at ? $category->created_at->format('d M Y') : '-' }}</td>
                        @endif

                        @if (in_array('updated_at', $visibleFields))
                            <td>{{ $category->updated_at ? $category->updated_at->format('d M Y') : '-' }}</td>
                        @endif

                        {{-- Actions --}}
                        <td>
                            <div class="category-action-buttons btn-group-dropdown " style="display:flex; gap:8px; align-items:center;">
                                <button class="btn-edit dropdown-toggle" onclick="toggleDropdown(this)">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>

                                <div class="dropdown-menu-custom">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Delete</button>
                                </form>
                                <a href="{{ route('admin.categories.detail', $category->id) }}" class="btn-detail">View</a>
                               </div>
                                
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="category-pagination">
       {{ $categories->links('admin.components.pagination.custom') }}
    </div>
</div>
@endsection
