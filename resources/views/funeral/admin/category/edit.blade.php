@extends('layouts.admin.admin-app')
@section('title', 'Update Category')
@section('content')
    {{-- header --}}
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-end flex-wrap">
                <div class="me-md-3 me-xl-5">
                    <h3>Inventory Management,</h3>
                    <p class="mb-md-0">Your analytics dashboard inventory.</p>
                </div>
                <div class="d-flex">
                    <i class="mdi mdi-bulletin-board text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Inventory &nbsp;/&nbsp;</p>
                    <p class="text-primary mb-0 hover-cursor">Edit Catergory</p>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-end flex-wrap">
                <a href="{{ url('admin/category') }}" class="btn btn-danger float-end text-white">
                    Back
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('admin/category/' . $category->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- name & slug --}}
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="">Category Name :</label>
                                <input type="text" name="name" value="{{ $category->name }}" class="form-control"
                                    placeholder="Category Name">
                                @error('name')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="col-md-6 ">
                                <label for=""> Name :</label>
                                <input type="text" name="slug" value="{{ $category->slug }}" class="form-control"
                                    placeholder="Name">
                                @error('slug')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>
                        {{-- end name & slug --}}
                        <div class="col-md-12 mb-3">
                            <label for="">Description :</label>
                            <textarea name="description" rows="5" class="form-control" placeholder="Description">{{ $category->description }}</textarea>
                            @error('description')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Image :</label>
                            <input type="file" name="image" class="form-control">
                            <img src="{{ asset("$category->image") }}" style="width:250px; height:250px;"
                                class="mx-auto d-block mt-2" />
                            @error('image')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Status :</label>
                            <input type="checkbox" name="status" {{ $category->status == '1' ? 'checked' : ' ' }}>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary float-end text-white">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
