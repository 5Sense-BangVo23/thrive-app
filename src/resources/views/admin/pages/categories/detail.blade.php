<style>
    .detail-container {
    width: 210mm;          /* chuẩn khổ A4 ngang */
    min-height: 297mm;     /* chuẩn A4 dọc */
    margin: 30px auto;
    padding: 40px;
    background: #fff;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    box-sizing: border-box;
    color: #2c3e50;
}

.detail-card {
    max-width: 100%;
}

.detail-title {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 16px;
    border-bottom: 2px solid #ecf0f1;
    padding-bottom: 8px;
}

.detail-meta {
    display: flex;
    gap: 16px;
    font-size: 14px;
    color: #7f8c8d;
    margin-bottom: 30px;
    flex-wrap: wrap;
}

.status {
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 600;
    color: white;
    text-transform: capitalize;
    min-width: 100px;
    text-align: center;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}
.status.draft {
    background-color: #f39c12;
}
.status.published {
    background-color: #27ae60;
}
.status.archived {
    background-color: #59a3a9;
}

.status.unknown {
    background-color: #e74c3c;
}


.timestamp {
    white-space: nowrap;
}

.detail-section h4 {
    font-size: 18px;
    color: #34495e;
    margin-bottom: 8px;
}

.detail-section p {
    background: #f8f9fa;
    padding: 14px 16px;
    border-radius: 6px;
    border: 1px solid #ddd;
    font-size: 15px;
    line-height: 1.5;
    color: #34495e;
    white-space: pre-line;
}

.detail-actions {
    margin-top: 40px;
    text-align: right;
}

.btn-back {
    background: linear-gradient(135deg, #3498db, #2980b9);
    color: #fff;
    padding: 10px 22px;
    font-weight: 600;
    border-radius: 8px;
    text-decoration: none;
    box-shadow: 0 4px 8px rgba(41, 128, 185, 0.3);
    transition: background 0.3s ease;
    display: inline-block;
}

.btn-back:hover {
    background: linear-gradient(135deg, #2980b9, #2471a3);
    box-shadow: 0 6px 12px rgba(36, 113, 163, 0.4);
}

</style>

@extends('admin.layout.home')

@section('title', 'Category Detail')

@section('content')
<div class="detail-container">
    <div class="detail-card">
        <h2 class="detail-title">{{ $category->name }}</h2>

       <div class="detail-meta">
            <span class="status {{ strtolower($category->publish_status ?: 'unknown') }}">
                {{ ucfirst($category->publish_status ?: 'unknown') }}
            </span>


           @if($category->created_at)
                <span class="timestamp">
                    <i class="fas fa-clock" aria-hidden="true"></i> {{ $category->created_at->format('d M Y') }}
                </span>
            @else
                <span class="timestamp">
                    <i class="fas fa-clock" aria-hidden="true"></i> N/A
                </span>
            @endif

            @if($category->updated_at)
                <span class="timestamp">
                    <i class="fas fa-clock" aria-hidden="true"></i> {{ $category->updated_at->format('d M Y') }}
                </span>
            @else
                <span class="timestamp">
                    <i class="fas fa-clock" aria-hidden="true"></i> N/A
                </span>
            @endif

        </div>


        <div class="detail-section">
            <h4>Description</h4>
            <p>{{ $category->description }}</p>
        </div>

        <div class="detail-actions">
            <a href="{{ route('admin.categories.list') }}" class="btn btn-back">Back to List</a>
        </div>
    </div>
</div>
@endsection
