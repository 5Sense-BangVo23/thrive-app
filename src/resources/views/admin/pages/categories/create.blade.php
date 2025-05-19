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
@section('title', 'Create category')
@section('content')
<div class="form-container">
    <h2 class="form-title">Add New Category</h2>

    @if ($errors->any())
        <div class="form-error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


   <form action="{{ route('admin.categories.store') }}" method="POST" id="add-category-form">
    @csrf

    <div class="form-group">
        <label for="category-name" class="form-label">Category Name</label>
        <input 
            type="text" 
            id="category-name" 
            name="name" 
            class="form-input @error('name') is-invalid @enderror" 
            value="{{ old('name') }}" 
            required 
        />
        @error('name')
            <div class="form-error-message">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="category-description" class="form-label">Description</label>
        <textarea 
            id="category-description" 
            name="description" 
            class="form-textarea @error('description') is-invalid @enderror" 
            required
        >{{ old('description') }}</textarea>
        @error('description')
            <div class="form-error-message">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-button-group">
        <button type="submit" class="btn-submit">Save</button>
        <a href="{{ route('admin.categories.list') }}" class="btn-cancel">Cancel</a>
    </div>
</form>

</div>
@endsection
