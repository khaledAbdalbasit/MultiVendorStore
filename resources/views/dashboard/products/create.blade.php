@extends('layouts.dashbord')
@section('title','Create products')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
<form action="{{route('dashboard.products.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('dashboard.products._form')
</form>
@endsection
