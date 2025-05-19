<style>
.nail-admin-container {
    max-width: 1000px;
    margin: 40px auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
}

.nail-admin-title {
    font-size: 28px;
    margin-bottom: 24px;
    color: #e91e63; 
    font-weight: bold;
    text-align: center;
}

.nail-btn-add-product {
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

.nail-btn-add-product:hover {
    background-color: #7b1fa2;
}

.nail-alert-success {
    padding: 12px;
    background-color: #e8f5e9;
    color: #2e7d32;
    margin-bottom: 20px;
    border-radius: 6px;
    border: 1px solid #c8e6c9;
}

.nail-no-products {
    text-align: center;
    color: #999;
    font-style: italic;
    margin-top: 20px;
}

.nail-products-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.nail-products-table thead {
    background-color: #fce4ec;
}

.nail-products-table th,
.nail-products-table td {
    padding: 12px;
    font-size: 14px;
    border-bottom: 1px solid #eee;
    color: #333;
}

.nail-products-table tbody tr:hover {
    background-color: #f9f9f9;
}

.nail-action-buttons {
    display: flex;
    gap: 10px;
}

.nail-btn-edit,
.nail-btn-delete {
    padding: 6px 12px;
    font-size: 13px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    text-decoration: none;
    color: #fff;
    transition: background-color 0.2s ease;
}

.nail-btn-edit {
    background-color: #f39c12;
}

.nail-btn-edit:hover {
    background-color: #e67e22;
}

.nail-btn-delete {
    background-color: #e91e63;
}

.nail-btn-delete:hover {
    background-color: #c2185b;
}

.nail-btn-detail {
    padding: 6px 12px;
    font-size: 13px;
    border-radius: 6px;
    background-color: #03a9f4;
    text-decoration: none;
    color: #fff;
    transition: background-color 0.2s ease;
}

.nail-btn-detail:hover {
    background-color: #0288d1;
}


.nail-pagination {
    margin-top: 24px;
    text-align: center;
}

</style>
@extends('admin.layout.home')
@section('title', 'Product list')
@section('content')
<div class="nail-admin-container">
    <h2 class="nail-admin-title">Nail Products List</h2>

    <a href="{{ route('admin.products.create') }}" class="nail-btn-add-product">+ Add New Product</a>

    @if(session('success'))
        <div class="nail-alert-success">{{ session('success') }}</div>
    @endif

    @if(empty($products))
        <div class="nail-no-products">No products available.</div>
    @else
        <table class="nail-products-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price (USD)</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ ucfirst($product['category'] ?? 'Uncategorized') }}</td>
                        <td>${{ number_format($product['price'], 2) }}</td>
                        <td>{{ $product['quantity'] }}</td>
                        <td>
                            <div class="nail-action-buttons">
                                <a href="{{ route('admin.products.edit', $product['id']) }}" class="nail-btn-edit">Edit</a>
                                <form action="{{ route('admin.products.delete', $product['id']) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="nail-btn-delete">Delete</button>
                                </form>
                                <a href="{{ route('admin.products.detail', $product['id']) }}" class="nail-btn-detail">View</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="nail-pagination">
        {{-- {{ $products->links() }} --}}
    </div>
</div>
@endsection
