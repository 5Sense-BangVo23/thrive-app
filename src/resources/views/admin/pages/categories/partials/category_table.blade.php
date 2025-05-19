@if(empty($categories) || count($categories) == 0)
    <div class="category-no-items">No categories available.</div>
@else
    <table class="category-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Category Name</th>
                <th>Description</th>
                <th>Published status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $index => $category)
                <tr>
                    <td>{{ $category['id'] }}</td>
                    <td>{{ $category['name'] }}</td>
                    <td>{{ $category['description'] ?? '-' }}</td>
                    <td>
                        {{ $category->publish_status ?? 'No status' }}
                    </td>

                    <td>
                        <div class="category-action-buttons">
                            <a href="{{ route('admin.categories.edit', $category['id']) }}" class="category-btn-edit">Edit</a>
                            <form action="{{ route('admin.categories.delete', $category['id']) }}" method="POST" onsubmit="return confirm('Are you sure to delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="category-btn-delete">Delete</button>
                            </form>
                            <a href="{{ route('admin.categories.detail', $category['id']) }}" class="category-btn-detail">View</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
