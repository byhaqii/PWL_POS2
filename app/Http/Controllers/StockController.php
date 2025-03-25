<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Models\Item;
use App\Models\Stock;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StockController extends Controller
{
    public function page() {
        $stocks = Stock::all();
        $items = Item::all();
        $metadata = [
            'pageTitle' => 'Stocks',
            'breadcrumbs' => [
                [
                    'name' => 'Stocks',
                    'route' => 'stocks.page'
                ],
                [
                    'name' => 'List',
                    'route' => '#'
                ],
            ]
        ];

        return view('pages.stock.index', compact('stocks', 'items', 'metadata'));
    }

    public function storePage() {
        $items = Item::all();
        $metadata = [
            'pageTitle' => 'Create Stock',
            'breadcrumbs' => [
                [
                    'name' => 'Stocks',
                    'route' => 'stocks.page'
                ],
                [
                    'name' => 'Create',
                    'route' => '#'
                ],
            ]
        ];

        return view('pages.stock.store', compact('metadata', 'items'));
    }

    public function updatePage(string $id) {
        $items = Item::all();
        $stock = Stock::findOrFail($id);
        $metadata = [
            'pageTitle' => 'Update Stock',
            'breadcrumbs' => [
                [
                    'name' => 'Stocks',
                    'route' => 'stocks.page'
                ],
                [
                    'name' => 'Update',
                    'route' => '#'
                ],
            ]
        ];

        return view('pages.stock.update', compact('metadata', 'stock', 'items'));
    }

    public function list(Request $request) {
        $stocks = Stock::with('item', 'user')->get();

        return DataTables::of($stocks)
        ->addIndexColumn()
        ->addColumn('actions', function ($stock) {
            $btn = '<a href="' . route('stocks.show', ['id' => $stock->stock_id]) . '" class="btn btn-primary btn-sm">Details</a>';
            $btn .= '<a href="' . route('stocks.update-page', ['id' => $stock->stock_id]) . '" class="btn btn-warning btn-sm ml-0 ml-md-2">Update</a>';
            $btn .= '<form action="' . route('stocks.delete', ['id' => $stock->stock_id]) . '" method="POST" style="display:inline-block;">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm ml-0 ml-md-2" onclick="return confirm(\'Are you sure you want to delete this stock?\')">Delete</button></form>';

            return $btn;
        })
        ->addColumn('actions-ajax', function ($stock) {
            $btn = '<button type="button" class="details-stock-ajax-btn btn btn-primary btn-sm ml-0 ml-md-2" data-toggle="modal" data-target="#detailsStockAjaxModal" data-id="' . $stock->stock_id . '">Details</button>';
            $btn .= '<button type="button" class="update-stock-ajax-btn btn btn-warning btn-sm ml-0 ml-md-2" data-toggle="modal" data-target="#updateStockAjaxModal" data-id="' . $stock->stock_id . '">Update</button>';
            $btn .= '<button type="button" class="delete-stock-ajax-btn btn btn-danger btn-sm ml-0 ml-md-2" data-id="' . $stock->stock_id . '">Delete</button>';

            return $btn;
        })
        ->rawColumns(['actions', 'actions-ajax'])
        ->make(true);
    }

    public function store(StockRequest $request) {
        $validatedData = $request->validated();

        Stock::create([
            'item_id' => $validatedData['item_id'],
            'user_id' =>  4,
            'stock_qty' => $validatedData['stock_qty'],
        ]);

        return redirect()->route('stocks.page')->with('success', 'Stock created successfully.')->withInput($request->only('item_id', 'stock_qty'));
    }

    public function storeAjax(StockRequest $request) {
        if (!$request->validated()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create stock. Please check again your data.',
                'errors' => $request->errors(),
            ]);
        }

        $validatedData = $request->validated();
        Stock::create([
            'item_id' => $validatedData['item_id'],
            'user_id' =>  4,
            'stock_qty' => $validatedData['stock_qty'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Stock created successfully.',
            'data' => $validatedData
        ]);
    }

    public function show(string $id) {
        $stock = Stock::with('user', 'item')->findOrFail($id);
        $metadata = [
            'pageTitle' => 'Stock Details',
            'breadcrumbs' => [
                [
                    'name' => 'Stocks',
                    'route' => 'stocks.page'
                ],
                [
                    'name' => 'Details',
                    'route' => '#'
                ],
            ]
        ];

        return view('pages.stock.show', compact('stock', 'metadata'));
    }

    public function showAjax(string $id) {
        $stock = Stock::with('user', 'item')->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Stock details found.',
            'data' => $stock
        ]);
    }

    public function update(StockRequest $request, string $id) {
        $validatedData = $request->validated();

        $stock = Stock::findOrFail($id);
        $stock->update([
            'item_id' => $validatedData['item_id'],
            'user_id' =>  4,
            'stock_qty' => $validatedData['stock_qty'],
        ]);

        return redirect()->route('stocks.page')->with('success', 'Stock updated successfully.')->withInput($request->only('item_id', 'stock_qty'));
    }

    public function updateAjax(StockRequest $request, string $id) {
        if (!$request->validated()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update stock. Please check again your data.',
                'errors' => $request->errors(),
            ]);
        }

        $validatedData = $request->validated();

        $stock = Stock::findOrFail($id);
        $stock->update([
            'item_id' => $validatedData['item_id'],
            'stock_qty' => $validatedData['stock_qty'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully.',
            'data' => $validatedData
        ]);
    }

    public function delete(string $id) {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return redirect()->route('stocks.page')->with('success', 'Stock deleted successfully.');
    }

    public function deleteAjax(string $id) {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return response()->json([
            'success' => true,
            'message' => 'Stock deleted successfully.',
            'data' => $stock
        ]);
    }
}