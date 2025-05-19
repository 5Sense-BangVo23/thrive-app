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
  ]; 

  public function __construct(Service $service)
  {
      $this->service = $service;
  }


  public function list(Request $request)
  {
      $categoriesCollection = $this->service->getAll(self::DISPLAY_FIELDS); // Collection

      $perPage = 10;
      $currentPage = LengthAwarePaginator::resolveCurrentPage();
      $currentItems = $categoriesCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();

      $paginator = new LengthAwarePaginator(
          $currentItems,
          $categoriesCollection->count(),
          $perPage,
          $currentPage,
          ['path' => LengthAwarePaginator::resolveCurrentPath()]
      );

      $categories = $paginator;

      if ($request->ajax()) {
          return view('admin.categories.partials.category_table', compact('categories'))->render();
      }

      return view('admin.pages.categories.list', compact('categories'));
  }

  public function create()
  {
      $category = $this->service->newCategory();
      return view('admin.pages.categories.create', compact('category'));
  }

  public function store(CategoryStoreRequest $request)
  {
      $data = $request->validated();
      $category = $this->service->create($data);
      return redirect()->route('admin.categories.list')->with('success', 'Category created successfully!');
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
                          ->with('error', 'Category not found.');
      }

      $category->update([
          'name' => $validated['name'],
          'description' => $validated['description'],
      ]);

      $category->setPublishStatus($validated['status']);

      return redirect()->route('admin.categories.list')
                      ->with('success', 'Category updated successfully.');
  }



  public function view($id)
  {
    $category = [
      'id' => $id,
      'name' => 'Category '.$id,
      'description' => 'This is the description for category '.$id,
    ];

    return view('admin.pages.categories.detail', compact('category'));
  }

  public function detroy($id)
  {
    return redirect()->route('admin.categories')->with('success', 'Category deleted successfully!');
  }
}