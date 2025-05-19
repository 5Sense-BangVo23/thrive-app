@extends('admin.layout.home')
@section('title', 'Product Edit')
@section('content')
<div class="container form-container">
    <h2>Edit Product</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

   <form action="{{ route('admin.products.edit', $product['id']) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="name">Product Name</label>
    <input type="text" id="name" name="name" value="{{ old('name', $product['name']) }}" required>

    <label for="category">Category</label>
    <select id="category" name="category" required>
        <option value="">-- Select Category --</option>
        <option value="tools" {{ old('category', $product['category']) == 'tools' ? 'selected' : '' }}>Tools</option>
        <option value="accessories" {{ old('category', $product['category']) == 'accessories' ? 'selected' : '' }}>Accessories</option>
    </select>

    <label for="price">Price</label>
    <input type="number" step="0.01" id="price" name="price" value="{{ old('price', $product['price']) }}" required>

    <button type="submit" class="btn-submit">Update</button>
    <a href="{{ route('admin.products.list') }}" class="btn-cancel">Cancel</a>
</form>

</div>

<style>
    .form-container {
        max-width: 600px;
        margin: 2rem auto;
        padding: 1rem 2rem;
        background: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 6px rgba(0,0,0,0.1);
    }
    label {
        display: block;
        margin: 1rem 0 0.5rem;
        font-weight: 600;
    }
    input[type="text"],
    input[type="number"],
    textarea,
    select {
        width: 100%;
        padding: 0.6rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1rem;
    }
    button.btn-submit {
        margin-top: 1.5rem;
        padding: 0.6rem 1.5rem;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    button.btn-submit:hover {
        background-color: #0056b3;
    }
    a.btn-cancel {
        margin-left: 1rem;
        padding: 0.6rem 1.5rem;
        background-color: #6c757d;
        color: white;
        border-radius: 4px;
        text-decoration: none;
    }
    a.btn-cancel:hover {
        background-color: #565e64;
    }
</style>
@endsection
