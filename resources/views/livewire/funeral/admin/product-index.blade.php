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
                    <p class="text-primary mb-0 hover-cursor"> Product</p>
                </div>
            </div>
            {{-- <div class="d-flex justify-content-between align-items-end flex-wrap">
                <a href="{{ url('admin/productinventory') }}"
                    class="btn btn-inverse-primary  btn-sm me-3 mt-2 mt-xl-0">
                    <i class="mdi mdi-clock-fast "></i>
                </a>
                <a href="{{ url('admin/products/create') }}" class="btn btn-primary float-end text-white">
                    Add Product
                </a>
            </div> --}}
        </div>
    </div>


    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>
                    <a href="{{ url('admin/products/create') }}"
                        class="btn btn-primary btn-icon-text btn-sm text-white float-end mx-1">
                        <i class="mdi mdi-exit-to-app btn-icon-prepend"></i>
                        Add Product
                    </a>
                    {{-- <a href="{{ url('admin/productinventory') }}"
                        class="btn btn-info btn-icon-text btn-sm text-white float-end mx-1">
                        <i class="mdi mdi-clock-fast "></i>
                        Inventory Logs
                    </a>
                    <a href="{{ url('admin/product-reports') }}" target="_blank"
                        class="btn btn-warning btn-icon-text btn-sm text-white float-end">
                        <i class="mdi mdi-file-xml btn-icon-prepend"></i>
                        Generate Reports
                    </a> --}}
                </h3>
            </div>
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
                                <th>ID</th>
                                <th>Category</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr class="text-center">
                                    <td style="font-color:black; font-weight:600;">{{ $product->id }}</td>
                                    <td>
                                        @if ($product->category)
                                            {{ $product->category->name }}
                                        @else
                                            No Category
                                        @endif
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td><span style="font-weight:500">₱ </span>{{ $product->selling_price }} <span>.00</span></td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>
                                        @if ($product->status == '0')
                                            <span class="badge rounded-pill bg-success">Vissible</span>
                                        @else
                                            <span class="badge rounded-pill bg-warning">Hidden</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->quantity)
                                            <span class="badge rounded-pill bg-success">In stock</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">Out of stock</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('admin/products/' . $product->id . '/edit') }}"
                                            class="btn btn-outline-success btn-sm">
                                            <i class='mdi mdi-pen btn-icon-prepend'></i>
                                            {{-- Edit --}}
                                        </a>
                                        <a href="{{ url('admin/products/' . $product->id . '/delete') }}"
                                            class="btn btn-outline-danger btn-sm delete">
                                            <i class='mdi mdi mdi-delete-sweep btn-icon-prepend'></i>
                                            {{-- Delete --}}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="8" class="text-center">
                                    No Products Available!
                                </td>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3 d-flex justify-content-center " style="background-color: white;">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
