<style>
    .form-container {
            max-width: 600px;
            background-color: #ffffff;
            padding: 30px 40px;
            margin: 40px auto;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            text-align: center;
            color: #333333;
            margin-bottom: 25px;
            font-size: 24px;
            font-weight: 700;
        }

        .form-group {
            margin-top: 15px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #444444;
            margin-bottom: 6px;
        }

        .form-input,
        .form-textarea,
        .form-select {
            width: 100%;
            padding: 10px 12px;
            font-size: 14px;
            border: 1px solid #cccccc;
            border-radius: 6px;
            transition: border-color 0.3s ease;
        }

        .form-input:focus,
        .form-textarea:focus,
        .form-select:focus {
            border-color: #7c3aed;
            outline: none;
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-error-message {
            background-color: #ffe5e5;
            color: #d93025;
            border: 1px solid #d93025;
            border-radius: 6px;
            padding: 12px 15px;
            margin-bottom: 15px;
        }

        .form-error-message ul {
            margin: 0;
            padding-left: 20px;
        }

        .form-button-group {
            margin-top: 25px;
            display: flex;
            justify-content: flex-start;
            gap: 12px;
        }

        .btn-submit {
            background-color: #7c3aed;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #682dc8;
        }

        .btn-cancel {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-cancel:hover {
            background-color: #5a6268;
            text-decoration: none;
            color: white;
        }
</style>

@extends('admin.layout.home')
@section('title', 'Create product')
@section('content')
<div class="form-container">
        <h2 class="form-title">Add New Nail Product</h2>

        @if ($errors->any())
            <div class="form-error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" id="add-nail-product-form">
            @csrf

            <div class="form-group">
                <label for="product-name" class="form-label">Product Name</label>
                <input type="text" id="product-name" name="name" class="form-input" value="{{ old('name') }}" required />
            </div>

            <div class="form-group">
                <label for="product-description" class="form-label">Description</label>
                <textarea id="product-description" name="description" class="form-textarea" required>{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="product-category" class="form-label">Category</label>
                <select id="product-category" name="category" class="form-select" required>
                    <option value="">-- Select Category --</option>
                    <option value="tools" {{ old('category') == 'tools' ? 'selected' : '' }}>Tools</option>
                    <option value="polish" {{ old('category') == 'polish' ? 'selected' : '' }}>Nail Polish</option>
                    <option value="accessories" {{ old('category') == 'accessories' ? 'selected' : '' }}>Accessories</option>
                </select>
            </div>

            <div class="form-group">
                <label for="product-price" class="form-label">Price (USD)</label>
                <input type="number" id="product-price" name="price" class="form-input" step="0.01" value="{{ old('price') }}" required />
            </div>

            <div class="form-group">
                <label for="product-quantity" class="form-label">Quantity</label>
                <input type="number" id="product-quantity" name="quantity" class="form-input" value="{{ old('quantity') }}" required />
            </div>

            <div class="form-button-group">
                <button type="submit" class="btn-submit">Save</button>
                <a href="{{ route('admin.products.list') }}" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
@endsection
