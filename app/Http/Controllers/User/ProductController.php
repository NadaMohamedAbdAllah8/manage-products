<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\UserFavoriteProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagiantionValue = $_GET['pagination'] ?? config('global.defaultPagination');

        $products = Product::where('category_id', '!=', null)
            ->whereHas('category', function ($query) {
                $query->where('deleted_at', '=', null);
            })->paginate($pagiantionValue);

        $data = [
            'title' => 'Products',
            'products' => $products,
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

            $userFavoriteProductExist = UserFavoriteProduct::
                where('product_id', $productId)
                ->where('user_id', $userId)->first();

            if (is_null($userFavoriteProductExist)) {
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
            return redirect()->back()->with('error', 'Error' . $e->getMessage());
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
            $pagiantionValue = $_GET['pagination'] ?? config('global.defaultPagination');

            $userFavoritesProducts = Auth::guard('user')->user()
                ->favoriteProducts()->paginate($pagiantionValue);

            $data = [
                'title' => 'Favorites Product Details',
                'products' => $userFavoritesProducts,
            ];

            return view('user.pages.products.show-favorites', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error ' . $e->getMessage());
        }
    }
}