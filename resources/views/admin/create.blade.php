@extends('admin.layout')

@section('styles')
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ config('app.name')}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Create Product</h4>
                    </div>
                    <!-- form start -->
                    <form action="{{ route('store') }}" method="POST" id="product-form" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Enter title" required=""
                                    name="title" value="{{ old('title') }}">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" required id="description"
                                    placeholder="Enter description">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="color">Color</label>
                                <select name="color" class="form-control" required id="color">
                                    <option value="">Select color</option>
                                    @foreach($colors as $key => $color)
                                    <option value="{{ $color }}" {{ old('color') == $color ? 'selected' : '' }}>
                                        {{ $color }}</option>
                                    @endforeach
                                </select>
                                @error('color')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="size">Size</label>
                                <select name="size" class="form-control" required id="size">
                                    <option value="">Select size</option>
                                    @foreach($sizes as $key => $size)
                                    <option value="{{ $size }}" {{ old('size') == $size ? 'selected' : '' }}>{{ $size }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('size')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">Image Upload</label>
                                <div class="input-group">
                                    <input type="file" id="image" name="image" accept="image" required>
                                </div>
                                @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('scripts')
@endsection
