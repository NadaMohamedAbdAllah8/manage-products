<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(config('global.defaultPagination'));

        $data = [
            'title' => 'Products',
            'products' => $products,
        ];

        return view('admin.pages.products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Create New Product',
            'categories' => Category::all(),
        ];

        return view('admin.pages.products.create', $data);
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
            'name' => 'required|string|max:255|doesnt_contain_word_example',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        try {
            Product::create($request->all());

            return redirect()->route('admin.product.index')
                ->with('success', 'Successfully Added');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error'.$e->getMessage());
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
            $product = Product::findOrFail($id);

            $data = [
                'title' => 'Product Details',
                'product' => $product,
            ];

            return view('admin.pages.products.show', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error '.$e->getMessage());
        }
    }
}
