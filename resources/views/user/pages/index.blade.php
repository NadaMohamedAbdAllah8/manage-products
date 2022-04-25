@extends('layouts.master')
@extends('user.layouts.header')
@section('title')
{{ $title ??'Welcome' }}
@endsection

@section('content')

<div class=" formdiv">

          <a href="{{route('product.product')}}" style="display: block">Products</a>

          <a href="{{route('product.product')}}" style="display: block">Categories</a>
</div>

@endsection