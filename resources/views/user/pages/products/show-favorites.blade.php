@extends('layouts.master')
@extends('user.layouts.header')

@section('title')
{{ $title }}
@endsection

@section('content')

<div class="container">
    <div class="card">
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
            <a href="{{ route('user.product.index')}}" class="btn btn-primary actionbtn">
                Back
            </a>
            <div class="d-flex justify-content-center">
                {!! $products->links() !!}

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
            No records
            @endif
        </div>
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