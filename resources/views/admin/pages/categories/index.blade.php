@extends('layouts.master')
@extends('admin.layouts.header')

@section('title')
{{ $title }}
@endsection

@section('content')

{{-- <x-alert id="my-alert" role="alert" type="success" style="background-color: blueviolet">
    {{$message}}
</x-alert> --}}

<x-alert :message="$message" />

<a href="{{ route('admin.category.create')}}" class="btn btn-primary actionbtn">
    Create Category
</a>



<div class="container">
    <div class="card">
        <div class="card-body">

            @if (count($categories) != 0)
            <table class="table table-dark" id="main-table">
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

            </div>
            @else
            No records
            @endif

        </div>
    </div>
</div>

@endsection