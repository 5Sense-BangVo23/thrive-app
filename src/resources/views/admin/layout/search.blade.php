<style>
.search-form {
    max-width: 700px;
    margin: 20px auto;
    padding: 10px 12px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    font-family: Arial, sans-serif;
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.form-label {
    display: none; /* ẩn label để tiết kiệm chỗ, placeholder đủ rõ */
}

.form-input {
    flex: 2 1 60%;
    padding: 8px 12px;
    font-size: 14px;
    border: 1.5px solid #ccc;
    border-radius: 6px;
    background: #fafafa;
    color: #333;
    transition: 0.25s;
    font-weight: 500;
}

.form-input:focus {
    border-color: #5c6bc0;
    background: #fff;
    outline: none;
    box-shadow: 0 0 6px rgba(92, 107, 192, 0.4);
}

.form-select {
    flex: 1 1 20%;
    padding: 8px 12px;
    font-size: 14px;
    border: 1.5px solid #ccc;
    border-radius: 6px;
    background: #fafafa;
    color: #333;
    appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg fill='%23666' height='8' viewBox='0 0 10 7' width='10' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0l5 7 5-7z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 10px 7px;
    cursor: pointer;
    transition: 0.25s;
}

.form-select:focus {
    border-color: #5c6bc0;
    background: #fff;
    outline: none;
    box-shadow: 0 0 6px rgba(92, 107, 192, 0.4);
}

.btn-submit,
.btn-cancel {
    flex: 1 1 15%;
    padding: 8px 0;
    font-weight: 600;
    font-size: 14px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    text-align: center;
    transition: background-color 0.3s ease;
}

.btn-submit {
    background-color: #5c6bc0;
    color: #fff;
}

.btn-submit:hover {
    background-color: #3f51b5;
}

.btn-cancel {
    background-color: #eee;
    color: #444;
    text-decoration: none;
    border: 1.5px solid transparent;
}

.btn-cancel:hover {
    background-color: #ddd;
    border-color: #ccc;
}

@media (max-width: 520px) {
    .search-form {
        flex-direction: column;
        align-items: stretch;
    }
    .form-input,
    .form-select,
    .btn-submit,
    .btn-cancel {
        flex: 1 1 100%;
        margin-bottom: 10px;
    }
}

</style>
<form action="{{ $route }}" method="GET" id="search-form" class="search-form">
    <input 
        type="text" 
        id="search-query" 
        name="search" 
        class="form-input" 
        placeholder="Search by..." 
        value="{{ request('search') }}" 
    />
    <select 
        id="search-status" 
        name="status" 
        class="form-select"
        aria-label="Status"
    >
        <option value="">All</option>
        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
        <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
    </select>
    <button type="submit" class="btn-submit">Find</button>
    <a href="{{ $cancelRoute ?? url()->current() }}" class="btn-cancel">Cancel</a>
</form>
