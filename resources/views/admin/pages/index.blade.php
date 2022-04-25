@extends('layouts.master')
@extends('admin.layouts.header')
@section('title')
{{ $title ??'Welcome' }}
@endsection

@section('content')

<div class=" formdiv">

          <a href="{{route('admin.product.index')}}" style="display: block">Products</a>

          <a href="{{route('admin.category.index')}}" style="display: block">Categories</a>
</div>

@endsection