<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function page() {
        $categories = Category::all();
        $metadata = [
            'pageTitle' => 'Categories',
            'breadcrumbs' => [
                [
                    'name' => 'Categories',
                    'route' => 'categories.page'
                ],
                [
                    'name' => 'List',
                    'route' => '#'
                ],
            ]
        ];

        return view('pages.category.index', compact('categories', 'metadata'));
    }

    public function storePage() {
        $metadata = [
            'pageTitle' => 'Create Category',
            'breadcrumbs' => [
                [
                    'name' => 'Categories',
                    'route' => 'categories.page'
                ],
                [
                    'name' => 'Create',
                    'route' => '#'
                ],
            ]
        ];

        return view('pages.category.store', compact('metadata'));
    }

    public function updatePage(string $id) {
        $category = Category::findOrFail($id);
        $metadata = [
            'pageTitle' => 'Update Category',
            'breadcrumbs' => [
                [
                    'name' => 'Categories',
                    'route' => 'categories.page'
                ],
                [
                    'name' => 'Update',
                    'route' => '#'
                ],
            ]
        ];

        return view('pages.category.update', compact('metadata', 'category'));
    }

    public function list(Request $request) {
        $categories = Category::all();

        return DataTables::of($categories)
        ->addIndexColumn()
        ->addColumn('actions', function ($category) {
            $btn = '<a href="' . route('categories.show', ['id' => $category->category_id]) . '" class="btn btn-primary btn-sm">Details</a>';
            $btn .= '<a href="' . route('categories.update-page', ['id' => $category->category_id]) . '" class="btn btn-warning btn-sm ml-0 ml-md-2">Update</a>';
            $btn .= '<form action="' . route('categories.delete', ['id' => $category->category_id]) . '" method="POST" style="display:inline-block;">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm ml-0 ml-md-2" onclick="return confirm(\'Are you sure you want to delete this category?\')">Delete</button></form>';

            return $btn;
        })
        ->rawColumns(['actions'])
        ->make(true);
    }

    public function store(CategoryRequest $request) {
        $validatedData = $request->validated();

        Category::create([
            'category_code' => $validatedData['category_code'],
            'category_name' => $validatedData['category_name'],
        ]);

        return redirect()->route('categories.page')->with('success', 'Caetgory created successfully.')->withInput($request->only('category_code', 'category_name'));
    }

    public function show(string $id) {
        $category = Category::findOrFail($id);
        $metadata = [
            'pageTitle' => 'Category Details',
            'breadcrumbs' => [
                [
                    'name' => 'Categories',
                    'route' => 'categories.page'
                ],
                [
                    'name' => 'Details',
                    'route' => '#'
                ],
            ]
        ];

        return view('pages.category.show', compact('category', 'metadata'));
    }

    public function update(CategoryRequest $request, string $id) {
        $validatedData = $request->validated();

        $category = Category::findOrFail($id);
        $category->update([
            'category_code' => $validatedData['category_code'],
            'category_name' => $validatedData['category_name'],
        ]);

        return redirect()->route('categories.page')->with('success', 'Category updated successfully.')->withInput($request->only('category_code', 'category_name'));
    }

    public function delete(string $id) {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.page')->with('success', 'Category deleted successfully.');
    }
}
