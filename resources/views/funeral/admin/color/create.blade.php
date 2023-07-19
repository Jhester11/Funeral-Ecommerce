@extends('layouts.admin.admin-app')
@section('title', 'Add Colors')

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
                    <p class="text-primary mb-0 hover-cursor"> Add Color</p>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-end flex-wrap">
                <a href="{{ url('admin/colors') }}" class="btn btn-danger float-end text-white">
                    Back
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        @if ($errors->any())
                            <div class="alert alert-warning">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <form action="{{ url('admin/colors/create') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>Color Name :</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Color Code :</label>
                                <input type="text" name="code" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Status</label><br />
                                <input type="checkbox" name="status" style="width: 20px; height:20px;"> Checked=Hidden,
                                UnChecked=Visible
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
    </div>
@endsection
