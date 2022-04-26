@extends('layouts.master')
@extends('user.layouts.header')

@section('title')
{{ $title }}
@endsection

@section('content')

<a href="{{ route('user.product.show-favorites')}}" style="width:20%" class="btn btn-primary actionbtn">
    Favorites Product list
</a>

<div class="container formdiv">
    <div class="card">

        <form id="search-form" method="GET" action="{{ route('user.product.search')}}">
            <div class="input-group mb-3">
                <input form="search-form" name="product_name" type="text" class="form-control"
                    placeholder="Product Name" style="width: 90%"
                    value="@if(isset($_GET['product_name'])){{ $_GET['product_name'] }}@endif" aria-label="product_name"
                    aria-describedby="basic-addon1">

                <select form="search-form" multiple name="category_id[]">
                    <option>Categories</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}" @if (isset($_GET['category_id']) &&
                        $_GET['category_id']==$category->id) selected
                        @endif>{{$category->name}}
                        @endforeach
                </select>
            </div>
            <button type="submit" form="search-form" class="btn btn-primary">Search</button>
            <a class="btn btn-primary" href="{{ route('user.product.index') }}">
                Remove Search</a>

        </form>
        <div class="card-body">
            @if(count($products) != 0)
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product->category->name?? 'No category assigned' }}</td>
                        <td>
                            <form action="{{ route('user.product.favorite',$product->id)}}" style="display: inline"
                                method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <button type="sumbit" class="btn-looklike-link" title=Favorite>
                                    Favorite</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {!! $products->appends($_GET)->links() !!}
            </div>
            @else
            No records
            @endif
        </div>
    </div>
</div>

@endsection