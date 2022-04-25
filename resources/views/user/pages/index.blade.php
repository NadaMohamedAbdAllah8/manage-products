@extends('layouts.master')
@extends('user.layouts.header')
@section('title')
{{ $title ??'Welcome' }}
@endsection

@section('content')

<div class=" formdiv">

          <a href="{{route('user.product.index')}}" style="display: block">Products</a>

          {{-- <a href="{{route('admin.category.index')}}" style="display: block">Categories</a> --}}
</div>

@endsection