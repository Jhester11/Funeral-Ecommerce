@section('title', 'Brand')
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
                    <p class="text-primary mb-0 hover-cursor"> Brand</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-10 mt-3 mx-auto">
        <div class="row">
            <div class="card  mx-auto">

                <div class="card-body ">
                    {{-- Search And Add --}}
                    <div class="row mb-3">
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
                        <div>
                            <button wire:click="showBrandModal" class="btn btn-inverse-primary btn-sm">
                                <i class="mdi mdi mdi-open-in-new menu-icon btn-icon-append"></i>
                                New Brand
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="recent-purchases-listing" class="table table-hover">
                            <thead class="text-center bg-primary text-white">
                                <tr style="font-weight:600;">
                                    <th>ID</th>
                                    <th>Brand Name</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($brands as $brand)
                                    <tr class="text-center">
                                        <td style="font-color:black; font-weight:600;"> {{ $brand->id }}</td>
                                        <td> {{ $brand->name }}</td>
                                        <td>
                                            @if ($brand->category)
                                                {{ $brand->category->name }}
                                            @else
                                                No Category
                                            @endif
                                        </td>
                                        <td> {{ $brand->slug }}</td>
                                        <td class="text-center">
                                            @if ($brand->status == '0')
                                                <span class="badge rounded-pill bg-success">Vissible</span>
                                            @else
                                                <span class="badge rounded-pill bg-warning">Hidden</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button href="" wire:click="showEditModal({{ $brand->id }})"
                                                class="btn btn-outline-success btn-sm">
                                                <i class="mdi mdi-pen btn-icon-prepend"></i>
                                                {{-- Edit --}}
                                            </button>
                                            <button href="" wire:click="deleteBrand({{ $brand->id }})"
                                                class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal">
                                                <i class="mdi mdi mdi-delete-sweep btn-icon-prepend"></i>
                                                {{-- Delete --}}
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="6" class="text-center">
                                        No Brands Found!
                                    </td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    {{ $brands->links() }}
                </div>
            </div>
            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="brandModal" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="brandModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            @if ($editMode)
                                <h1 class="modal-title fs-5" id="brandModal">Edit Brand</h1>
                            @else
                                <h1 class="modal-title fs-5" id="brandModal"> Create Brand</h1>
                            @endif
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form wire:submit.prevent="storeBrand">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="">Select Category</label>
                                    <select wire:model="category_id" required class="form-control" id="">
                                        <option value="">
                                            --Select Category--
                                        </option>
                                        @foreach ($categories as $cateItem)
                                            <option value="{{ $cateItem->id }}">
                                                {{ $cateItem->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for=""> Brand Name</label>
                                    <input type="text" wire:model="name" class="form-control">
                                    @error('name')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for=""> Name</label>
                                    <input type="text" wire:model="slug" class="form-control">
                                    @error('slug')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for=""> Status</label> <br />
                                    <input type="checkbox" wire:model.defer="status" style="width: 70px;height=70px" />
                                    Checked=Hidden, Un-checked=Visible
                                </div>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-inverse-secondary" wire:click="closeModal">
                                <i class="mdi mdi mdi-exit-to-app btn-icon-append"></i>
                                Close
                            </button>
                            @if ($editMode)
                                <button type="button" class="btn btn-primary text-white" wire:click="updateBrand()">
                                    <i class="mdi mdi mdi-autorenew "></i>
                                    Update
                                </button>
                            @else
                                <button type="button" class="btn btn-inverse-primary btn-fw "
                                    wire:click="storeBrand()">
                                    <i class="mdi mdi mdi-file-check btn-icon-append"></i>
                                    Save
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script for sweet alert notification delete --}}
<script type="text/javascript">
    // Store
    window.addEventListener('swal:store', event => {
        Swal.fire(
            'Success!',
            'Brand successfully Added.',
            'success'
        )
    });
    // Update
    window.addEventListener('swal:update', event => {
        Swal.fire(
            'Success!',
            'Brand successfully updated.',
            'success'
        )
    });
    // Delete
    window.addEventListener('show-delete-confirmation', event => {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('deleteConfirmed');
            }
        })
    });
    window.addEventListener('brandDelete', event => {
        Swal.fire(
            'Deleted!',
            'Brand has been deleted.',
            'success'
        )
    });
</script>