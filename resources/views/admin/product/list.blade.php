@extends('layouts.admin') @section('title', 'Product List') @section('content')
<div class="row justify-content-center ">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h2 class="card-title">Product List</h2>
                <button type="button" class="btn btn-primary" id="sale_btn">On Sale</button>
            </div>
            <div class="card-body">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th> <input type="checkbox" id="check_all_pro"></th>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Discount</th>
                            <th>Label</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    <input type="checkbox" name="product_id[]" value="{{ $product->id }}">
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <!-- Display product images as thumbnails -->
                                    <div class="d-flex flex-wrap">
                                        @foreach ($product->images as $image)
                                            @if ($loop->first)
                                                <img src="{{ asset($image->image_path) }}" alt="{{ $product->name }}"
                                                    class="img-thumbnail mr-2 mb-2"
                                                    style="
                                            max-width: 50px;
                                            max-height: 50px;
                                            width: 50px;
                                            height: 50px;
                                            background-size: cover;
                                        " />
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->discount }}</td>
                                <td>{{ $product->product_label }}</td>

                                <td>{{ $product->category->name }}</td>
                                <td>
                                    @if ($product->status == 'available')
                                        <span class="badge badge-success">Available</span>
                                    @else
                                        <span class="badge badge-danger">Not Available</span>
                                    @endif
                                </td>
                                <td>
                                    <a type="button" style="cursor: pointer" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                
                                        <a href="{{ route('admin.products.show', base64_encode($product->id)) }}" class="btn dropdown-item">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn dropdown-item">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger"
                                                onclick="return confirm('Are you sure you want to delete this?')">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-12">
                        {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="saleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Discount on Products</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home"
                            type="button" role="tab" aria-controls="nav-home" aria-selected="true">Create New</button>
                        <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile"
                            type="button" role="tab" aria-controls="nav-profile"
                            aria-selected="false">Update Old</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                        aria-labelledby="nav-home-tab">
                        <form action="{{ route('admin.discounts.product') }}" method="POST">
                            @csrf
                            <input type="hidden" value="" id="product_ids" name="product_ids">
                            <div class="form-group">
                                <label for="">Title </label>
                                <input required type="text" name="title" class="form-control" id="">
                            </div>
                            <div class="form-group">
                                <label for="">Enter From Date</label>
                                <input required type="date" name="start_date" class="form-control" id="">
                            </div>
                            <div class="form-group">
                                <label for="">Enter To Date</label>
                                <input required type="date" name="end_date" class="form-control" id="">
                            </div>
                            <div class="form-group">
                                <label for="">Enter Discount (%)</label>
                                <input required type="nmber" min="0" max="100" name="discount"
                                    class="form-control" id="">
                            </div>
                            <div class=" d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary mx-2 " data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>

                            </div>
                        </form>
                    </div>



                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <form action="{{ route('admin.discounts.product') }}" method="POST">
                            @csrf
                            <input type="hidden" value="" id="product_ids" name="product_ids">
                           <div class="form-group">
                            <select id="title" class="form-control" name="title" required>
                                <option value="" selected disabled>Select Discount Title</option>
                                @foreach($discountTitles as $discountTitle)
                                    <option value="{{ $discountTitle->title }}" {{ ($discount && $discount->title == $discountTitle->title) ? 'selected' : '' }}>
                                        {{ $discountTitle->title }}
                                    </option>
                                @endforeach
                            </select>
                           </div>
                           <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary float-rigt" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary float-rigt">Save changes</button>

                        </div>
                    </form>
                    </div>


                    </div>
                </div>



        </div>

    </div>
</div>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        var table = $('.table').DataTable();
        $('#check_all_pro').on('click', function() {
            var rows = table.rows({
                'search': 'applied'
            }).nodes();

            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });


        $('#sale_btn').click(function() {
            let ArrayPro = [];
            $('input[name="product_id[]"]').each(function() {
                if (this.checked) {
                    ArrayPro.push(this.value)
                }
            });
            console.log(ArrayPro);
            $('#product_ids').val(ArrayPro);
            $('#saleModal').modal('show');

        });

    });
</script>
@endpush
