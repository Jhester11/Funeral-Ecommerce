<div class="row">
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
                    <p class="text-primary mb-0 hover-cursor"> Slider</p>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-end flex-wrap">
                <a href="{{ url('admin/sliders/create') }}" class="btn btn-primary float-end text-white">
                    Add Slider
                </a>
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                {{-- Search  --}}
                <div class="col mt-3">
                    <form>
                        <div class="form-row align-items-center">
                            <div class="col">
                                <input type="search" wire:model="search" class="form-control  mb-2 "
                                    id="inlineFormInput" placeholder="Search now....">
                            </div>
                            <div class="col" wire:loading class="p-2">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>Loading...
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table id="recent-purchases-listing" class="table table-hover">
                        <thead class="text-center bg-primary text-white">
                            <tr style="font-weight:600;">
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sliders as $slider)
                                <tr class="text-center">
                                    <td style="font-color:black; font-weight:600;">
                                        {{ $slider->id }}
                                    </td>
                                    <td>
                                        {{ $slider->title }}
                                    </td>
                                    <td>
                                        {{ $slider->description }}
                                    </td>
                                    <td>
                                        <img src="{{ asset("$slider->image") }}" style="width: 60px; height:60px"
                                            alt="sliderImage">
                                    </td>
                                    <td>
                                        @if ($slider->status == '0')
                                            <span class="badge rounded-pill bg-success">Vissible</span>
                                        @else
                                            <span class="badge rounded-pill bg-warning">Hidden</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/sliders/' . $slider->id . '/edit') }}"
                                            class="btn btn-outline-success btn-sm">
                                            <i class='mdi mdi-pen btn-icon-prepend'></i>
                                            {{-- Edit --}}
                                        </a>
                                        <a href="{{ url('admin/sliders/' . $slider->id . '/delete') }}"
                                            class="btn btn-outline-danger btn-sm delete">
                                            <i class='mdi mdi mdi-delete-sweep btn-icon-prepend'></i>
                                            {{-- Delete --}}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="6" class="text-center">
                                    No Slider  Found!
                                </td>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3 d-flex justify-content-center " style="background-color: white;">
                        {{ $sliders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
