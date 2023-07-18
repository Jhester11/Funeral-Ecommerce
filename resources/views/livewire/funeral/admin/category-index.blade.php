<div class="row">
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
                    <p class="text-primary mb-0 hover-cursor"> Catergory</p>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-end flex-wrap">
                <a href="{{ url('admin/category/create') }}" class="btn btn-primary float-end text-white">
                    Add Category
                </a>
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                {{-- Search --}}
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
                                <th> ID </th>
                                <th> Name </th>
                                <th> Status </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr class="text-center">
                                    <td style="font-color:black; font-weight:600;"> {{ $category->id }}</td>
                                    <td> {{ $category->name }}</td>
                                    <td>
                                        @if ($category->status == '0')
                                            <span class="badge rounded-pill bg-success">Vissible</span>
                                        @else
                                            <span class="badge rounded-pill bg-warning">Hidden</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/category/' . $category->id . '/edit') }}"
                                            class="btn btn-outline-success btn-sm"> <i
                                                class="mdi mdi-pen btn-icon-prepend"></i>
                                            {{-- Edit --}}
                                        </a>
                                        <a href="{{ url('admin/category/' . $category->id . '/delete') }}"
                                            class="btn btn-outline-danger btn-sm delete">
                                            <i class="mdi mdi mdi-delete-sweep btn-icon-prepend"></i>
                                            {{-- Delete --}}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="4" class="text-center">
                                    No Category Found!
                                </td>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3 d-flex justify-content-center " style="background-color: white;">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

