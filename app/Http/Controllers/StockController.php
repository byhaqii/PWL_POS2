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

        return view('pages.stock.index', compact('stocks', 'metadata'));
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
        ->rawColumns(['actions'])
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

    public function delete(string $id) {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return redirect()->route('stocks.page')->with('success', 'Stock deleted successfully.');
    }
}
