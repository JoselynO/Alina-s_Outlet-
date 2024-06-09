@php use App\Models\Category; @endphp

@extends('main')

@section('title', 'Alina Luxury - Categories')

@section('content')
    @include('normalhead')
    <div class="container mb-lg-5 mt-5">
        <h2>Our Categories</h2>
                <div class="row">
                        <div class="col-md-3">
                            <a class="btn btn-primary mb-lg-4 mt-4" href="{{ route('categories.create') }}">Create Category</a>
                        </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                @if($category->id!=1)
                                <td><img src="{{ asset('storage/' . $category->image) }}" style="width: 45px" onerror="this.onerror=null; this.src='{{$category->image}}'"></td>
                                    <td>{{ $category->name }}</td>
                                <td><div class="btn-group" role="group" ><a class="btn btn-primary" href="{{ route('categories.edit', $category->id) }}">Edit</a>
                                    <a class="btn btn-secondary" href="{{ route('categories.editImage', $category->id) }}">EditImage</a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                    @endif
                                    </div>
                                </td>

                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-container">
                        {{ $categories->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
@endsection
