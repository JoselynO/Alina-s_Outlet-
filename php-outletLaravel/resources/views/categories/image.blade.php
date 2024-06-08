@php use App\Models\Category; @endphp

@extends('main')

@section('title', 'Alina Luxury - Categories')

@section('content')
    @include('normalhead')
    <h1 class="text-center mt-5 mb-3" style="color: black; font-weight: bolder">Edit Image Category</h1>
    <div class="container mt-3 mb-5" style=" text-align: center; ">
        <p><span style="color: black; font-weight: bolder">ID:</span> {{$category->id}}</p>
        <p><span style="color: black; font-weight: bolder">Name:</span> {{$category->name}}</p>
        <p>  @if($category->image != Category::$IMAGE_DEFAULT)
                <img  src="{{ asset('storage/' . $category->image) }}"   style="width: 250px"  onerror="this.onerror=null; this.src='{{$category->image}}'"/>
            @else
                <img  src="{{ Category::$IMAGE_DEFAULT}}" alt="{{ $category->name }}"  style="width: 250px"/>
            @endif</p>
        <form action="{{ route('categories.updateImage', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div  class="form-group" style=" text-align: center;">
                <label for="image">Select an Image for the Category</label>
                <input type="file" name="image" required class="form-control" style=" width: 15cm;margin: 0 auto; ">
                <div class="invalid-feedback"> Please select an Image valid</div>
            </div>
            <button type="submit" class="btn btn-primary">Update Image</button>
            <a class="btn btn-secondary mx-2" href="{{ route('categories.index') }}">Back</a>

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

