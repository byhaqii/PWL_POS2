<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    public function page() {
        $items = Item::with('category')->get();
        $categories = Category::all();
        $metadata = [
            'pageTitle' => 'Items',
            'breadcrumbs' => [
                [
                    'name' => 'Items',
                    'route' => 'items.page'
                ],
                [
                    'name' => 'List',
                    'route' => '#'
                ],
            ]
        ];

        return view('pages.item.index', compact('items', 'categories', 'metadata'));
    }

    public function storePage() {
        $categories = Category::all();
        $metadata = [
            'pageTitle' => 'Create Item',
            'breadcrumbs' => [
                [
                    'name' => 'Items',
                    'route' => 'items.page'
                ],
                [
                    'name' => 'Create',
                    'route' => '#'
                ],
            ]
        ];

        return view('pages.item.store', compact('metadata', 'categories'));
    }

    public function updatePage(string $id) {
        $categories = Category::all();
        $item = Item::with('category')->findOrFail($id);
        $metadata = [
            'pageTitle' => 'Update Item',
            'breadcrumbs' => [
                [
                    'name' => 'Items',
                    'route' => 'items.page'
                ],
                [
                    'name' => 'Update',
                    'route' => '#'
                ],
            ]
        ];

        return view('pages.item.update', compact('metadata', 'item', 'categories'));
    }

    public function list(Request $request) {
        $items = Item::with('category')->get();

        return DataTables::of($items)
        ->addIndexColumn()
        ->addColumn('actions', function ($item) {
            $btn = '<a href="' . route('items.show', ['id' => $item->item_id]) . '" class="btn btn-primary btn-sm">Details</a>';
            $btn .= '<a href="' . route('items.update-page', ['id' => $item->item_id]) . '" class="btn btn-warning btn-sm ml-0 ml-md-2">Update</a>';
            $btn .= '<form action="' . route('items.delete', ['id' => $item->item_id]) . '" method="POST" style="display:inline-block;">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm ml-0 ml-md-2" onclick="return confirm(\'Are you sure you want to delete this item?\')">Delete</button></form>';

            return $btn;
        })
        ->addColumn('actions-ajax', function ($item) {
            $btn = '<button type="button" class="details-item-ajax-btn btn btn-primary btn-sm ml-0 ml-md-2" data-toggle="modal" data-target="#detailsItemAjaxModal" data-id="' . $item->item_id . '">Details</button>';
            $btn .= '<button type="button" class="update-item-ajax-btn btn btn-warning btn-sm ml-0 ml-md-2" data-toggle="modal" data-target="#updateItemAjaxModal" data-id="' . $item->item_id . '">Update</button>';
            $btn .= '<button type="button" class="delete-item-ajax-btn btn btn-danger btn-sm ml-0 ml-md-2" data-id="' . $item->item_id . '">Delete</button>';

            return $btn;
        })
        ->rawColumns(['actions', 'actions-ajax'])
        ->make(true);
    }

    public function store(ItemRequest $request) {
        $validatedData = $request->validated();

        Item::create([
            'category_id' => $validatedData['category_id'],
            'item_code' => $validatedData['item_code'],
            'item_name' => $validatedData['item_name'],
            'item_buy_price' => $validatedData['item_buy_price'],
            'item_sell_price' => $validatedData['item_sell_price'],
        ]);

        return redirect()->route('items.page')->with('success', 'Item created successfully.')->withInput($request->only('category_id', 'item_code', 'item_name', 'item_buy_price', 'item_sell_price'));
    }

    public function storeAjax(ItemRequest $request) {
        if (!$request->validated()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create item. Please check again your data.',
                'errors' => $request->errors(),
            ]);
        }

        $validatedData = $request->validated();
        Item::create([
            'category_id' => $validatedData['category_id'],
            'item_code' => $validatedData['item_code'],
            'item_name' => $validatedData['item_name'],
            'item_buy_price' => $validatedData['item_buy_price'],
            'item_sell_price' => $validatedData['item_sell_price'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Item created successfully.',
            'data' => $validatedData
        ]);
    }

    public function show(string $id) {
        $item = Item::findOrFail($id);
        $metadata = [
            'pageTitle' => 'Item Details',
            'breadcrumbs' => [
                [
                    'name' => 'Items',
                    'route' => 'items.page'
                ],
                [
                    'name' => 'Details',
                    'route' => '#'
                ],
            ]
        ];

        return view('pages.item.show', compact('item', 'metadata'));
    }

    public function showAjax(string $id) {
        $item = Item::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Item details found.',
            'data' => $item
        ]);
    }

    public function update(ItemRequest $request, string $id) {
        $validatedData = $request->validated();

        $item = Item::findOrFail($id);
        $item->update([
            'category_id' => $validatedData['category_id'],
            'item_code' => $validatedData['item_code'],
            'item_name' => $validatedData['item_name'],
            'item_buy_price' => $validatedData['item_buy_price'],
            'item_sell_price' => $validatedData['item_sell_price'],
        ]);

        return redirect()->route('items.page')->with('success', 'Item updated successfully.')->withInput($request->only('category_id', 'item_code', 'item_name', 'item_buy_price', 'item_sell_price'));
    }

    public function updateAjax(ItemRequest $request, string $id) {
        if (!$request->validated()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update item. Please check again your data.',
                'errors' => $request->errors(),
            ]);
        }

        $validatedData = $request->validated();

        $item = Item::findOrFail($id);
        $item->update([
            'category_id' => $validatedData['category_id'],
            'item_code' => $validatedData['item_code'],
            'item_name' => $validatedData['item_name'],
            'item_buy_price' => $validatedData['item_buy_price'],
            'item_sell_price' => $validatedData['item_sell_price'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Item updated successfully.',
            'data' => $validatedData
        ]);
    }

    public function delete(string $id) {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('items.page')->with('success', 'Item deleted successfully.');
    }

    public function deleteAjax(string $id) {
        $item = Item::findOrFail($id);
        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item deleted successfully.',
            'data' => $item
        ]);
    }
}