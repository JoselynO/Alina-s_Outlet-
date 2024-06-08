@php use App\Models\Product; @endphp

@extends('main')

@section('title', 'Alina Luxury - Create Product')

@section('content')
    @include('normalhead')
                <h1 class="text-center mt-5" style="color: black; font-weight: bolder">Create a Product</h1>
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

                <div class="container-fluid py-5 md-5" >
                    <div class="row">
                        <div class="col-md-6 offset-md-3 ">
                            <form action="{{ route('products.store') }}"  method="POST"  id="create" style="margin-bottom: 2cm">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input class="form-control" id="name" name="name" type="text"  pattern="^(?!\s*$).+" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea class="form-control" id="description" name="description" type="text" rows="10" cols="50" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price:</label>
                                    <input class="form-control" id="price" name="price" type="number" required
                                           min="1.0" step="0.01"  value="0">
                                </div>
                                <div class="form-group">
                                    <label for="price_before">Price before:</label>
                                    <input class="form-control" id="price_before" name="price_before" type="number"
                                           min="1.0" step="0.01"  value="0">
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stock:</label>
                                    <input class="form-control" id="stock" name="stock" type="number" required
                                           min="1" value="0">
                                </div>

                                <div class="form-group">
                                    <label for="sex">Sex:</label>
                                    <select class="form-control" id="sex" name="sex" required>
                                        <option value="">Select a sex</option>
                                        <option value="unisex">unisex</option>
                                        <option value="woman">woman</option>
                                        <option value="man">man</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="category">Category:</label>
                                    <select class="form-control" id="category" name="category" required>
                                        <option value="">Select a category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="buttons-container d-flex justify-content-between mt-5">
                                    <button class="btn btn-primary " type="submit">Create</button>
                                    <a class="btn btn-secondary mx-2" href="{{ route('products.index') }}">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
@endsection
