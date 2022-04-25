@extends('admin.layouts.master')

@section('title')
    {{ $title }}
@endsection

@section('content')

    <center><h3>Category Details {{ $category->name_en }}</h3></center>

@endsection