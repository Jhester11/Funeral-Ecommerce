@extends('layouts.admin.admin-app')
@section('title', 'Edit Slider')

@section('content')
    {{-- header --}}
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-end flex-wrap">
                <div class="me-md-3 me-xl-5">
                    <h3>Slider Management,</h3>
                    <p class="mb-md-0">Your analytics dashboard slider.</p>
                </div>
                <div class="d-flex">
                    <i class="mdi mdi-view-carousel text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Home &nbsp;/&nbsp;</p>
                    <p class="text-primary mb-0 hover-cursor">Edit Slider</p>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-end flex-wrap">
                <a href="{{ url('admin/sliders') }}" class="btn btn-danger float-end text-white">
                    Back
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('admin/sliders/' . $slider->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT');
                        <div class="mb-3">
                            <label>Title :</label>
                            <input type="text" value="{{ $slider->title }}" name="title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Description :</label>
                            <textarea name="description" class="form-control" rows="4">{{ $slider->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Image :</label>
                            <input type="file" name="image" class="form-control" />
                            <img src="{{ asset("$slider->image") }}" style="width:250px; height:250px;"
                                class="mx-auto d-block mt-2" alt="sliderImage" required>
                        </div>
                        <div class="mb-3">
                            <label>Status</label><br />
                            <input type="checkbox" {{ $slider->status == '1' ? 'checked' : '' }} name="status"
                                style="width: 20px; height:20px;">
                            Checked=Hidden, UnChecked=Visible
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary text-white float-end">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
