<style>
    .nail-product-detail-wrapper {
    max-width: 720px;
    margin: 40px auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
    font-family: 'Segoe UI', sans-serif;
}

.nail-detail-title {
    font-size: 26px;
    font-weight: bold;
    color: #e91e63;
    text-align: center;
    margin-bottom: 30px;
}

.nail-product-detail-box {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.nail-detail-item label {
    font-weight: 600;
    color: #555;
    margin-bottom: 6px;
    font-size: 14px;
    display: block;
}

.nail-detail-value {
    background-color: #fce4ec;
    padding: 12px 16px;
    border-radius: 8px;
    font-size: 15px;
    color: #333;
    line-height: 1.5;
    border: 1px solid #f8bbd0;
}

.nail-detail-back {
    margin-top: 35px;
    text-align: center;
}

.nail-btn-back {
    display: inline-block;
    padding: 10px 20px;
    background-color: #9c27b0;
    color: #fff;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: background-color 0.25s ease;
}

.nail-btn-back:hover {
    background-color: #7b1fa2;
}

</style>
@extends('admin.layout.home')
@section('title', 'Product detail')
@section('content')
<div class="nail-product-detail-wrapper">
    <h2 class="nail-detail-title">View Product Detail</h2>

    <div class="nail-product-detail-box">
        <div class="nail-detail-item">
            <label>Name:</label>
            <div class="nail-detail-value">{{ $product['name'] }}</div>
        </div>

        <div class="nail-detail-item">
            <label>Category:</label>
            <div class="nail-detail-value">{{ ucfirst($product['category'] ?? 'Uncategorized') }}</div>
        </div>

        <div class="nail-detail-item">
            <label>Price:</label>
            <div class="nail-detail-value">${{ number_format($product['price'], 2) }}</div>
        </div>

        <div class="nail-detail-item">
            <label>Quantity:</label>
            <div class="nail-detail-value">{{ $product['quantity'] }}</div>
        </div>

        @if(!empty($product['description']))
        <div class="nail-detail-item">
            <label>Description:</label>
            <div class="nail-detail-value">{{ $product['description'] }}</div>
        </div>
        @endif
    </div>

    <div class="nail-detail-back">
        <a href="{{ route('admin.products.list') }}" class="nail-btn-back">← Back to Product List</a>
    </div>
</div>
@endsection
