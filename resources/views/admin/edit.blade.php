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
                        <h4>Edit Product</h4>
                    </div>
                    <!-- form start -->
                    <form action="{{ route('update', $product->id) }}" method="POST" id="product-form-edit">
                        @method('PUT')
                        <div class="card-body">


                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Enter title" required=""
                                    name="title" value="{{ $product->title }}">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" required id="description"
                                    placeholder="Enter description">{{ $product->description }}</textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="color">Color</label>
                                <select name="color" class="form-control" required id="color">
                                    <option value="">Select color</option>
                                    @foreach($colors as $key => $color)
                                    <option value="{{ $color }}" {{ $product->color == $color ? 'selected' : '' }}>
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
                                    <option value="{{ $size }}" {{ $product->size == $size ? 'selected' : '' }}>
                                        {{ $size }}</option>
                                    @endforeach
                                </select>
                                @error('size')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>
                </div>
                <!-- /.card -->
                <div class="card card-primary">

                    <form action="" method="POST" id="image-form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <div class="form-group">
                            <label for="image">Image Upload</label>
                            <div class="input-group">
                                <input type="file" id="image" name="image" accept="image">
                            </div>
                            <span class="text-danger" id="image-input-error"></span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success upload-image" type="submit" id="upload">Upload Image</button>
                        </div>
                    </form>
                </div>
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
<!-- SweetAlert2 -->
<script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    var uploadUrl = "{{ route('imageUpload') }}";
    $('#image-form').submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $('#image-input-error').text('');

        $.ajax({
            type: 'POST',
            url: uploadUrl,
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response) {
                    this.reset();
                    Swal.fire({
                        icon: 'success',
                        title: 'Image has been uploaded successfully'
                    })
                }
            },
            error: function (response) {
                console.log(response);
                $('#image-input-error').text(response.responseJSON.errors.file);
            }
        });
    });

</script>
@endsection
