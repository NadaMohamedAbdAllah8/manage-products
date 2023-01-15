<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(config('global.defaultPagination'));

        $data = [
            'title' => 'Categories',
            'categories' => $categories,
            'message' => 'Hello!',
        ];

        return view('admin.pages.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Create New Category',
        ];

        return view('admin.pages.categories.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            Category::create($request->all());

            return redirect()->route('admin.category.index')->withFragment('main-table')
                ->with('success', 'Successfully Added');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error '.$e->getMessage())
                ->withFragment('main-table');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            // Get products table pagination if it is set
            $paginationValue = $_GET['pagination'] ?? config('global.defaultPagination');

            $category = Category::findOrFail($id);

            $data = [
                'title' => 'Category Details',
                'category' => $category,
                'products' => $category->products()->paginate($paginationValue),
            ];

            return view('admin.pages.categories.show', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error '.$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = [
                'title' => 'Edit Category Details',
                'category' => Category::findOrFail($id),
            ];

            return view('admin.pages.categories.edit', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error '.$e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $category = Category::findOrFail($id);

            if ($category->name == $request->name) {
                $category->touch();
            }

            $category->update($request->only('name'));

            return redirect()->route('admin.category.index')
                ->with('success', 'Successfully Updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);

            $category->delete();

            return redirect()->route('admin.category.index')
                ->with('success', 'Successfully Deleted');
        } catch (\Exception $e) {
            return redirect()->route('admin.category.index')
                ->with('error', 'Error '.$e->getMessage());
        }
    }
}
