@php use App\Models\Product; @endphp

@extends('main')

@section('title', 'Alina Luxury - Gestion de Productos')

@section('content')
    @include('normalhead')
    <h1 class="text-center mt-5 mb-3" style="color: black; font-weight: bolder">Create a Product</h1>
    <div class="container mt-3 mb-5" style=" text-align: center; ">
        <p><span style="color: black; font-weight: bolder">ID:</span> {{$product->id}}</p>
        <p><span style="color: black; font-weight: bolder">Name:</span> {{$product->name}}</p>
        <p>  @if($product->image != Product::$IMAGE_DEFAULT)
                <img  src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"  style="width: 250px"  onerror="this.onerror=null; this.src='{{$product->image}}'"/>
            @else
                <img  src="{{ Product::$IMAGE_DEFAULT}}" alt="{{ $product->name }}"  style="width: 250px"/>
            @endif</p>
        <form action="{{ route('products.updateImage', $product->id) }}" method="POST"  enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div  class="form-group" style=" text-align: center;">
                <label for="image">Select an Image for the Product</label>
                <input type="file" name="image" required class="form-control" style=" width: 15cm;margin: 0 auto; ">
                <div class="invalid-feedback"> Please select an Image valid</div>
            </div>
            <button type="submit" class="btn btn-primary">Update Image</button>
            <a class="btn btn-secondary mx-2" href="{{ route('products.index') }}">Back</a>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br/>
            @endif
        </form>
    </div>
