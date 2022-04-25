@extends('layouts.master')
@extends('admin.layouts.header')

@section('title')
{{ $title }}
@endsection

@section('content')




<a href="{{ route('admin.category.create')}}" class="btn btn-primary actionbtn">
    Create Category
</a>



<div class="container">
    <div class="card">
        <div class="card-body">

            @if (count($categories) != 0)
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $category)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $category['name'] }}</td>
                        <td>

                            <a href="{{ route('admin.category.show',$category->id)}}" title="Show" class="">
                                Show</a>

                            <a href="{{ route('admin.category.edit',
                             $category->id)}}" title="Edit" class="">
                                Edit</a>

                            <form action="{{ route('admin.category.destroy',$category->id)}}" method="POST"
                                style="display: inline;">
                                @csrf {{ method_field('Delete') }}

                                <button type="sumbit" class="btn-looklike-link" title=Delete
                                    onclick="return confirm('Are you sure?')"> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {!! $categories->render() !!}

                @if($categories->hasPages())
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