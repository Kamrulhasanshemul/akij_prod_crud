@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        {{ __('Product CRUD for Akij') }}
                        @if (Auth::check())
                            <span class="float-right">
                                <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary">Create Product</a>
                            </span>
                        @endif
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (isset($products))
                            <div class="mt-2 mb-2">
                                <form action="{{ route('home') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exp_date">Expire Date</label>
                                                <input type="date" name="exp_date" id="exp_date" class="form-control"
                                                    value="{{ request()->get('exp_date') ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="number" name="price" id="price" class="form-control"
                                                    step="0.01" value="{{ request()->get('price') ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" value="Filter" class="btn btn-sm btn-success">
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Expire Date</th>
                                            @if (Auth::check())
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $key => $product)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->price }} BDT</td>
                                                <td>{{ $product->exp_date->format('d M Y') }}</td>
                                                @if (Auth::check())
                                                    <td>
                                                        <p>
                                                            <a href="{{ route('product.edit', $product->id) }}"
                                                                class="btn btn-warning btn-sm">
                                                                Edit
                                                            </a>
                                                        <form action="{{ route('product.destroy', $product->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm mt-1">Delete</button>
                                                        </form>
                                                        </p>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-danger">Please add a product first!</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
