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
        <input type="text" class="read-only-input" value="{{old('name',$category->name)}}">

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
            @if($products->hasPages())
            <div class="d-flex align-items-center py-3">
                <select class="form-control form-control-sm font-weight-bold mr-4 border-0 bg-light"
                    id="pagination_options" style="width:7%;">
                    <option value="{{config('global.defaultPagination')}}" @if(isset($_GET['pagination']))
                        @if($_GET['pagination']==config('global.defaultPagination')) selected @endif @endif>
                        {{config('global.defaultPagination')}}
                    </option>

                    <option value="{{config('global.paginationFirstIncrease')}}" @if(isset($_GET['pagination']) &&
                        $_GET['pagination']==config('global.paginationFirstIncrease')) selected @endif>
                        {{config('global.paginationFirstIncrease')}}
                    </option>

                    <option value="{{config('global.paginationSecondIncrease')}}" @if(isset($_GET['pagination'])&&
                        $_GET['pagination']==config('global.paginationSecondIncrease')) selected @endif>
                        {{config('global.paginationSecondIncrease')}}
                    </option>

                    <option value="{{config('global.paginationThirdIncrease')}}" @if(isset($_GET['pagination']) &&
                        $_GET['pagination']==config('global.paginationThirdIncrease')) selected @endif>
                        {{config('global.paginationThirdIncrease')}}
                    </option>

                </select>
            </div>
            @endif
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
@section('scripts')
<script>
    $( "#pagination_options" ).on( 'change', function () {
        var selectedPagination = $( this ).find( ":selected" ).val();

        var current_url = window.location.href.split( '?' );

        if ( current_url[ 0 ] ) {
            var url = current_url[ 0 ] + "?page=1&pagination=" + selectedPagination;
        } else {
            var url = window.location.href + "?page=1&pagination=" + selectedPagination;
        }
     
       window.location.href = url;
    } );
</script>
@endsection