@extends('layouts.admin') @section('title', 'Product List') @section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Product List</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>

                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <!-- Display product images as thumbnails -->
                                <div class="d-flex flex-wrap">
                                    @foreach ($product->images as $image)
                                    @if ($loop->first)


                                    <img
                                        src="{{ asset($image->image_path) }}"
                                        alt="{{ $product->name }}"
                                        class="img-thumbnail mr-2 mb-2"
                                        style="
                                            max-width: 50px;
                                            max-height: 50px;
                                            width: 50px;
                                            height: 50px;
                                            background-size: cover;
                                        "
                                    />
                                    @endif
                                    @endforeach
                                </div>
                            </td>
                            <td>{{ $product->name }}</td>

                            <td>{{ $product->category->name }}</td>
                            <td>
                                @if ($product->status == 'available')
                                <span class="badge badge-success"
                                    >Available</span
                                >
                                @else
                                <span class="badge badge-danger"
                                    >Not Available</span
                                >
                                @endif
                            </td>
                            <td>
                                <a
                                    type="button"
                                    style="cursor: pointer"
                                    data-toggle="dropdown"
                                >
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu">
                                    <a
                                        href=" {{ route('admin.products.edit', $product->id) }} "
                                        class="btn dropdown-item"
                                        >Edit</a
                                    >
                                    <form
                                        action="{{ route('admin.product.destroy', $product->id) }}"
                                        method="POST"
                                        style="display: inline"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn dropdown-item"
                                        >
                                            Delete
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
@endsection
