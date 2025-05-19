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

    .category-btn-edit,
    .category-btn-delete,
    .category-btn-detail {
        padding: 6px 12px;
        font-size: 13px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        color: #fff;
        white-space: nowrap;
        display: inline-block;
        transition: background-color 0.2s ease;
    }

    .category-btn-edit {
        background-color: #f39c12;
    }

    .category-btn-edit:hover {
        background-color: #e67e22;
    }

    .category-btn-delete {
        background-color: #e91e63;
    }

    .category-btn-delete:hover {
        background-color: #c2185b;
    }

    .category-btn-detail {
        background-color: #03a9f4;
    }

    .category-btn-detail:hover {
        background-color: #0288d1;
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

</style>


@extends('admin.layout.home')
@section('title', 'Category list')
@section('content')
<div class="category-admin-container">
    <h2 class="category-admin-title">Category List</h2>

    <a href="{{ route('admin.categories.create') }}" class="category-btn-add">+ Add New Category</a>

    @if(session('success'))
        <div class="category-alert-success">{{ session('success') }}</div>
    @endif

    @include('admin.pages.categories.partials.category_table')

    <div class="category-pagination">
       {{ $categories->links('admin.components.pagination.custom') }}
    </div>
</div>
@endsection


 <a href="javascript:void(0);" onclick="loadCategories();" class="category-btn-add">↻ Reload Categories</a>
<script>
    function loadCategories() {
        fetch("{{ route('admin.categories.list') }}", {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById('category-table-container').innerHTML = html;
        })
        .catch(error => {
            console.error('Error loading categories:', error);
        });
    }
</script>
