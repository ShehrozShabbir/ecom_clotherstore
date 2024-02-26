@extends('layouts.admin') @section('title',"Dashboard") @section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Hello, {{auth()->user()->name}}. Welcome to Dashboard!</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Products</h4>
                            </div>
                            <div class="card-body">
                                <div>
                                    <span class="badge badge-primary px-3">
                                        <p class="mb-0 h5"></p>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div></div>
                </div>
            </div>
        </div>
        {{-- end of card --}}
    </div>
</div>

@endsection
