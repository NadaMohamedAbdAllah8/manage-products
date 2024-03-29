<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\UserFavoriteProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('category_id', '!=', null)
            ->whereHas('category', function ($query) {
                $query->where('deleted_at', '=', null);
            })->paginate(config('global.defaultPagination'));

        $data = [
            'title' => 'Products',
            'products' => $products,
            'categories' => DB::select(DB::raw('SELECT * FROM categories where deleted_at is null')),
        ];

        return view('user.pages.products.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function favorite(Request $request)
    {
        try {
            $productId = $request->product_id;

            $userId = Auth::guard('user')->user()->id;

            $userFavoriteProductExist = UserFavoriteProduct::where(['product_id' => $productId, 'user_id' => $userId])->first();

            if (! is_null($userFavoriteProductExist)) {
                return redirect()->route('user.product.index')
                    ->with('error', 'Added Already');
            }

            $userFavoriteProduct = new UserFavoriteProduct();

            $userFavoriteProduct->product_id = $productId;

            $userFavoriteProduct->user_id = $userId;

            $userFavoriteProduct->save();

            return redirect()->route('user.product.index')
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
    public function showFavorites()
    {
        try {
            $paginationValue = $_GET['pagination'] ?? config('global.defaultPagination');

            // the user can view all the favorite products regardless of whether that product
            // has a category or not; as the category can be deleted

            $userFavoritesProducts = Auth::guard('user')->user()
                ->favoriteProducts()->paginate($paginationValue);

            $data = [
                'title' => 'Favorites Product Details',
                'products' => $userFavoritesProducts,
            ];

            return view('user.pages.products.show-favorites', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error '.$e->getMessage());
        }
    }

    //searchForm
    public function searchForm(Request $request)
    {
        $response = $this->search($request);

        if ($response['status'] == 'success') {
            return view('user.pages.products.index', $response);
        } else {
            return redirect(route('user.product.index'))->with('error', $response['error']);
        }
    }

    public function search(Request $request)
    {
        $categories = Category::all();

        $paginationValue = config('global.defaultPagination');

        $products = Product::where('category_id', '!=', null)
            ->whereHas('category', function ($query) {
                $query->where('deleted_at', '=', null);
            });

        try {
            $productName = $request->product_name;

            $categoriesId = $request->category_id;

            if (! is_null($productName)) {
                $products = $products->where('name', 'like', '%'.$productName.'%');
            }

            if (isset($categoriesId)) {
                $products = $products->whereHas('category', function ($query) use ($categoriesId) {
                    $query->whereIn('id', $categoriesId);
                });
            }

            return [
                'title' => 'Products',
                'status' => 'success',
                'products' => $products->paginate($paginationValue),
                'categories' => $categories,
            ];
        } catch (\Exception $e) {
            return [
                'title' => 'Products',
                'status' => 'error',
                'error' => $e->getMessage(),
                'products' => $products->paginate($paginationValue),
                'categories' => $categories,
            ];
        }
    }
}
