@php use App\Models\Category; @endphp

@extends('main')

@section('title', 'Alina Luxury - Categories')

@section('content')
    @include('normalhead')
                    <h1 class="text-center mt-5 mb-lg-3" style="color: black; font-weight: bolder">Create Category</h1>
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
                            <div class="col-md-6 offset-md-3 mb-lg-5">
                                <form action="{{ route('categories.store') }}"  method="POST"  style="margin-bottom: 2cm">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input class="form-control" id="name" name="name" type="text"  pattern="^(?!\s*$).+" required>
                                    </div>
                                    <div class="buttons-container d-flex justify-content-between mt-5 mb-lg-5">
                                        <button class="btn btn-primary " type="submit">Create</button>
                                        <a class="btn btn-secondary mx-2" href="{{ route('categories.index') }}">Back</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
@endsection


