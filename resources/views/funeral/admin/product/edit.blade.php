@extends('layouts.admin.admin-app')
@section('title', 'Edit Product')

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
                    <p class="text-primary mb-0 hover-cursor"> Add Product</p>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-end flex-wrap">
                <a href="{{ url('admin/products') }}" class="btn btn-danger float-end text-white">
                    Back
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ url('admin/products/' . $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home-tab-pane" type="button" role="tab"
                                    aria-controls="home-tab-pane" aria-selected="true">
                                    Home
                                </button>
                            </li>
                            
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                    data-bs-target="#details-tab-pane" type="button" role="tab"
                                    aria-controls="details-tab-pane" aria-selected="false">
                                    Details
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab"
                                    data-bs-target="#image-tab-pane" type="button" role="tab"
                                    aria-controls="image-tab-pane" aria-selected="false">
                                    Product Image
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="colors-tab" data-bs-toggle="tab"
                                    data-bs-target="#colors-tab-pane" type="button" role="tab">
                                    Product Colors
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active border p-3 " id="home-tab-pane" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0">
                                <div class="mb-3">
                                    <label for="">Select Category</label>
                                    <select name="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for=""> Product Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                                </div>
                                <div class="mb-3">
                                    <label for=""> Name</label>
                                    <input type="text" name="slug" value="{{ $product->slug }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="">Select Brand</label>
                                    <select name="brand" class="form-control">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->name }}"
                                                {{ $brand->name == $product->brand ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="">Small Description (500 Words)</label>
                                    <textarea name="small_description" rows="5" class="form-control">{{ $product->small_description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="">Description </label>
                                    <textarea name="description" rows="5" class="form-control">{{ $product->description }}</textarea>
                                </div>
                                
                            </div>



                            <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel"
                                aria-labelledby="details-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for=""> Original Price</label>
                                            <input type="text" name="original_price"
                                                value="{{ $product->original_price }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for=""> Selling Price</label>
                                            <input type="text" name="selling_price"
                                                value="{{ $product->selling_price }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for=""> Quantity</label>
                                            <input type="number" name="quantity" value="{{ $product->quantity }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for=""> Trending</label>
                                            <input type="checkbox" name="trending"
                                                {{ $product->trending == '1' ? 'checked' : '' }}
                                                style="width: 20px; height: 20px;">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for=""> Featured</label>
                                            <input type="checkbox" name="featured"
                                                {{ $product->featured == '1' ? 'checked' : '' }}
                                                style="width: 20px; height: 20px;">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for=""> Status</label>
                                            <input type="checkbox" name="status"
                                                {{ $product->status == '1' ? 'checked' : '' }}
                                                style="width: 20px; height: 20px;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel"
                                aria-labelledby="image-tab" tabindex="0">
                                <div class="mb-3">
                                    <label>Upload Product Images</label>
                                    <input type="file" name="image[]" multiple class="form-control" />
                                </div>
                                <div>
                                    @if ($product->productImages)
                                        <div class="row">
                                            @foreach ($product->productImages as $images)
                                                <div class="col-md-2 mx-auto">
                                                    <img src="{{ asset($images->image) }}"
                                                        style="width: 120px; height:90px;" class="me-4  mb-2 "
                                                        alt="productimage" />
                                                    <a onclick="return confirm('Are you sure you want to delete this image?')"
                                                        href="{{ url('admin/product-image/' . $images->id . '/delete') }}"
                                                        class="d-block d-flex justify-content-center">
                                                        Remove
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <h5>
                                            No Image Found!
                                        </h5>
                                    @endif
                                </div>
                            </div>

                            <div class="tab-pane fade border p-3" id="colors-tab-pane" role="tabpanel" tabindex="0">
                                <div class="mb-3">
                                    <h4>
                                        Add Product Color
                                    </h4>
                                    <label>Select Color</label>
                                    <hr />
                                    <div class="row">
                                        @forelse ($colors as $coloritem)
                                            <div class="col-md-4">
                                                <div class="p-2 border mb-3">
                                                    Color: <input type="checkbox" name="colors[{{ $coloritem->id }}]"
                                                        value="{{ $coloritem->id }}" />
                                                    {{ $coloritem->name }}
                                                    <br />
                                                    Quantity: <input type="number"
                                                        name="colorquantity[{{ $coloritem->id }}]"
                                                        style="width:70px;border: 1px solid;" />
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-md-4">
                                                <h4>
                                                    No colors found
                                                </h4>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered text-center">
                                        <thead>
                                            <tr>
                                                <th>Color Name</th>
                                                <th>Quantity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product->productColors as $prodColor)
                                                <tr class="prod-color-tr">
                                                    <td>
                                                        @if ($prodColor->color)
                                                            {{ $prodColor->color->name }}
                                                        @else
                                                            No Color Found
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="input-group mb-3" style="width: 150px">
                                                            <input type="text" value="{{ $prodColor->quantity }}"
                                                                class="productColorQuantity form-control form-control-sm" />
                                                            <button type="button" value="{{ $prodColor->id }}"
                                                                class="updateProductColorBtn btn btn-sm btn-primary text-white">
                                                                Update</button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" value="{{ $prodColor->id }}"
                                                            class="deleteProductColorBtn btn btn-sm btn-danger text-white">
                                                            <i class='bx bxs-trash'></i>
                                                            Delete
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="py-2 float-end">
                            <button type="submit" class="btn btn-primary  text-white float-end">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click', '.updateProductColorBtn', function() {
                var product_id = "{{ $product->id }}";
                var prod_color_id = $(this).val();
                var qty = $(this).closest('.prod-color-tr').find('.productColorQuantity').val();
                // alert(prod_color_id);

                // if (qty <= 0) {
                //     alert('Quantity is required');
                //     return false;
                // }
                var data = {
                    'product_id': product_id,
                    'qty': qty
                };

                $.ajax({
                    type: "POST",
                    url: "/admin/product-color/" + prod_color_id,
                    data: data,
                    success: function(response) {
                        alert(response.message);
                    }
                });
            });
            $(document).on('click', '.deleteProductColorBtn', function() {
                var prod_color_id = $(this).val();
                var thisClick = $(this);
                $.ajax({
                    type: "GET",
                    url: "/admin/product-color/" + prod_color_id + "/delete",
                    success: function(response) {
                        thisClick.closest('.prod-color-tr').remove();
                        alert(response.message);
                    }
                });
            });
        });
    </script>
@endsection
