@extends('layouts.dashbord')
@section('title','Categories')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')

<div class="mb-5">
    @can('categories.create')
    <a href="{{route('dashboard.categories.create')}}" class="btn btn-sm btn-outline-primary ">Create</a>
    @endcan
    <a href="{{route('dashboard.categories.trash')}}" class="btn btn-sm btn-outline-dark">Trash</a>
</div>
<x-alert type="success" />
<x-alert type="info" />
<form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">

    <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
    <select name="status" class="form-control mx-2">
        <option value="">All</option>
        <option value="active" @selected(request('status')=='active' )>Active</option>
        <option value="archived" @selected(request('status')=='archived' )>Archived</option>
    </select>
    <button class="btn btn-dark mx-2">Filter</button>
</form>
<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Numbers</th>
            <th>Status</th>
            <th>Created At</th>
            <th colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $category)
        <tr>
            <th><img src="{{asset('storage/' . $category->image)}}" alt="" height="50"></th>
            <td>{{$category->id}}</td>

            <td><a href="{{route('dashboard.categories.show',$category->id)}}">{{$category->name}}</a></td>
            <td>{{$category->parent->name}}</td>
            <td>{{$category->products_count}}</td>
            <td>{{$category->status}}</td>
            <td>{{$category->created_at}}</td>
            @can('categories.update')
            <td>
                <a href="{{route('dashboard.categories.edit',$category->id)}}" class="btn btn-sm btn-outline-success">Edit</a>
            </td>
            @endcan
            @can('categories.delete')
            <td>
                <!-- Form method spoofing -->
                <form action="{{route('dashboard.categories.destroy',$category->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="delete">
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
            @endcan
        </tr>
        @empty
        <tr>
            <td colspan="9">No categories define.</td>
        </tr>
        @endforelse

    </tbody>

</table>

{{$categories->withQueryString()->links()}}
@endsection
