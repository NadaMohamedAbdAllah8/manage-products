@extends('layouts.master')
@extends('admin.layouts.header')

@section('title')
{{ $title }}
@endsection

@section('content')
<div class="container">
    <div class="formdiv">
        <h1>Category</h1>
        <hr>

        <label for="username"><b>Category Name</b></label>
        <input type="text" placeholder="Enter Category Name" class="read-only-input"
            value="{{old('name',$category->name)}}" required>

        <label>Category's Products</label>
        <br />
        @if (count($products) != 0)
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $key => $product)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $product['name'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $products->render() !!}
        </div>
        @else
        No Products
        @endif

        <a href="{{ route('admin.category.index')}}" class="btn btn-primary actionbtn">
            Back
        </a>

    </div>
</div>

@endsection