<?php

namespace App\Http\Controllers;

use App\Http\Requests\LevelRequest;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    public function page() {
        $levels = Level::all();
        $metadata = [
            'pageTitle' => 'Levels',
            'breadcrumbs' => [
                [
                    'name' => 'Levels',
                    'route' => 'levels.page'
                ],
                [
                    'name' => 'List',
                    'route' => '#'
                ],
            ]
        ];

        return view('pages.level.index', compact('levels', 'metadata'));
    }

    public function storePage() {
        $levels = Level::all();
        $metadata = [
            'pageTitle' => 'Create Level',
            'breadcrumbs' => [
                [
                    'name' => 'Levels',
                    'route' => 'levels.page'
                ],
                [
                    'name' => 'Create',
                    'route' => '#'
                ],
            ]
        ];

        return view('pages.level.store', compact('metadata', 'levels'));
    }

    public function updatePage(string $id) {
        $level = Level::findOrFail($id);
        $metadata = [
            'pageTitle' => 'Update Level',
            'breadcrumbs' => [
                [
                    'name' => 'Levels',
                    'route' => 'levels.page'
                ],
                [
                    'name' => 'Update',
                    'route' => '#'
                ],
            ]
        ];

        return view('pages.level.update', compact('metadata', 'level'));
    }

    public function list(Request $request) {
        $levels = Level::all();

        return DataTables::of($levels)
        ->addIndexColumn()
        ->addColumn('actions', function ($level) {
            $btn = '<a href="' . route('levels.show', ['id' => $level->level_id]) . '" class="btn btn-primary btn-sm">Details</a>';
            $btn .= '<a href="' . route('levels.update-page', ['id' => $level->level_id]) . '" class="btn btn-warning btn-sm ml-0 ml-md-2">Update</a>';
            $btn .= '<form action="' . route('levels.delete', ['id' => $level->level_id]) . '" method="POST" style="display:inline-block;">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm ml-0 ml-md-2" onclick="return confirm(\'Are you sure you want to delete this level?\')">Delete</button></form>';

            return $btn;
        })
        ->rawColumns(['actions'])
        ->make(true);
    }

    public function store(LevelRequest $request) {
        $validatedData = $request->validated();

        Level::create([
            'level_code' => $validatedData['level_code'],
            'level_name' => $validatedData['level_name'],
        ]);

        return redirect()->route('levels.page')->with('success', 'Level created successfully.')->withInput($request->only('level_code', 'level_name'));
    }

    public function show(string $id) {
        $level = Level::findOrFail($id);
        $metadata = [
            'pageTitle' => 'Level Details',
            'breadcrumbs' => [
                [
                    'name' => 'Levels',
                    'route' => 'levels.page'
                ],
                [
                    'name' => 'Details',
                    'route' => '#'
                ],
            ]
        ];

        return view('pages.level.show', compact('level', 'metadata'));
    }

    public function update(LevelRequest $request, string $id) {
        $validatedData = $request->validated();

        $level = Level::findOrFail($id);
        $level->update([
            'level_code' => $validatedData['level_code'],
            'level_name' => $validatedData['level_name'],
        ]);

        return redirect()->route('levels.page')->with('success', 'Level updated successfully.')->withInput($request->only('level_code', 'level_name'));
    }

    public function delete(string $id) {
        $level = Level::findOrFail($id);
        $level->delete();

        return redirect()->route('levels.page')->with('success', 'Level deleted successfully.');
    }
}
