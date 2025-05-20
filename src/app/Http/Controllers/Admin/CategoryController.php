<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\TblCategory;
use App\Services\Admin\CategoryService as Service;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryController extends Controller
{
    protected $service;

    const DISPLAY_FIELDS = [
        'id',
        'name',
        'description',
        'created_at',
        'updated_at',
    ]; 

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function list(Request $request)
    {
        $data = $this->getListData($request);

        return view('admin.pages.categories.list', [
            'categories' => $data['paginator'],
            'fields' => $data['fields'],
            'visibleFields' => $data['visibleFields'],
            'cancelRoute' => $data['cancelRoute']
        ]);
    }

    public function search(Request $request)
    {
        $data = $this->getListData($request);

        return view('admin.pages.categories.list', [
            'categories' => $data['paginator'],
            'fields' => $data['fields'],
            'visibleFields' => $data['visibleFields'],
            'cancelRoute' => $data['cancelRoute']
        ]);
    }


    public function updateVisibility(Request $request)
    {
        $fields = $request->input('fields', []); 
        session(['category_visible_fields' => $fields]);

        return redirect()->route('admin.categories.list')
                         ->with('success', 'Visibility updated.')
                         ->with('success_time', now()->timestamp);;
    }

    public function create()
    {
        $category = $this->service->newCategory();
        return view('admin.pages.categories.create', compact('category'));
    }

    public function store(CategoryStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $this->service->create($data);

            return redirect()->route('admin.categories.list')
                            ->with('success', 'Category created successfully!')
                            ->with('success_time', now()->timestamp);

        } catch (\Exception $e) {
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Failed to create category. Please try again.')
                            ->with('error_time', now()->timestamp);
        }
    }

    public function edit($id)
    {
        $category = $this->service->getById($id, self::DISPLAY_FIELDS);

        if (!$category) {
            return redirect()->route('admin.categories.list')
                             ->with('error', 'Category not found.');
        }

        return view('admin.pages.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:draft,published,archived',
        ]);


        $category = $this->service->getById($id, self::DISPLAY_FIELDS);

        if (!$category) {
            return redirect()->route('admin.categories.list')
                            ->with('error', 'Category not found.')
                            ->with('error_time', now()->timestamp);
        }

        try {
            
            $category->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
            ]);

            $category->setPublishStatus($validated['status']);

            return redirect()->route('admin.categories.list')
                            ->with('success', 'Category updated successfully.')
                            ->with('success_time', now()->timestamp);

        } catch (\Exception $e) {
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Failed to update category. Please try again.')
                            ->with('error_time', now()->timestamp);
        }
    }


    public function view($id)
    {
        $category = $this->service->getById($id, self::DISPLAY_FIELDS);

        if (!$category) {
            return redirect()->route('admin.categories.list')
                            ->with('error', 'Category not found.');
        }

        return view('admin.pages.categories.detail', compact('category'));
    }


    public function detroy($id)
    {
        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully!');
    }

    public function softDelete($id)
    {
       
    }


    private function getListData(Request $request)
    {
        $searchTerm = $request->input('search');
        $status = $request->input('status');

        if ($searchTerm) {
            $categories = $this->service->search($searchTerm, null);
        } else if ($status) {
            $categories = $this->service->search(null, $status);
        } else {
            $categories = $this->service->getAll(self::DISPLAY_FIELDS);
        }

        if ($categories instanceof \Illuminate\Support\Collection) {
            $categories = $categories->map(function ($item) {
                $item->publish_status_label = match ($item->publish_status) {
                    'draft' => 'Draft',
                    'published' => 'Published',
                    'archived' => 'Archived',
                    default => 'Unknown',
                };
                return $item;
            });
        }
        $paginator = $this->service->paginate($categories, 10);

        $fields = self::DISPLAY_FIELDS;
        $visibleFields = session('category_visible_fields', array_merge(self::DISPLAY_FIELDS, ['publish_status']));
        $cancelRoute = route('admin.categories.list');

        return compact('paginator', 'fields', 'visibleFields', 'cancelRoute');
    }

}
