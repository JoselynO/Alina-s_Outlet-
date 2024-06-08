@php use App\Models\Product; @endphp
@extends('main')

@section('title', 'Alina Luxury -Gestion Products')

@section('content')
    @include('normalhead')
        <div class="container">
            <h2>Our Products</h2>
            <div class="row">
                <div class="col-md-3">
                    <a class="btn btn-primary" href="{{ route('products.create') }}">Create a Product</a>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Price before</th>
                        <th>Stock</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($products as $product)
                        <tr>
                                <td>
                                    @if($product->image != Product::$IMAGE_DEFAULT)
                                        <img  src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"  style="width: 90px"  onerror="this.onerror=null; this.src='{{$product->image}}'"/>
                                    @else
                                        <img  src="{{ Product::$IMAGE_DEFAULT}}" alt="{{ $product->name }}"  style="width: 90px"/>
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>€{{ $product->price }}</td>
                                <td>@if($product->price_before && $product->price_before > 0) €{{ $product->price_before }} @else <p style="text-align: center">-</p> @endif</td>
                                <td>{{ $product->stock }}</td>
                                <td><button><a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Edit</a></button>
                                    <button><a class="btn btn-secondary" href="{{ route('products.editImage', $product->id) }}">EditImage</a></button>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination-container">
                    {{ $products->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
@endsection
