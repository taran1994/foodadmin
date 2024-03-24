@extends('dashboard.body.main')
@section('specificpagescripts')
<script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endsection
@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-folder"></i></div>
                        Edit Category
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('categories.update', $category->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
<div class="col-xl-4">
                <!-- Product image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Category Image</div>
                    <div class="card-body text-center">
                        <!-- Product image -->
                        <img style="width:100%"  class="img-account-profile mb-2" src="{{ $category->category_image ? asset('storage/products/'.$category->category_image) : asset('assets/img/products/default.webp') }}" alt="" id="image-preview" />
                        <!-- Product image help block -->
                        <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 2 MB</div>
                        <!-- Product image input -->
                        <input class="form-control form-control-solid mb-2 @error('category_image') is-invalid @enderror" type="file"  id="image" name="category_image" accept="image/*" onchange="previewImage();">
                        @error('category_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- BEGIN: Category Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Category Details
                    </div>
                    <div class="card-body">
                        <!-- Form Group (name) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="name">Category Name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('name') is-invalid @enderror" id="name" name="name" type="text" placeholder="" value="{{ old('name', $category->name) }}" autocomplete="off" />
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- Form Group (slug) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="slug">Category Slug (non editable).</label>
                            <input class="form-control form-control-solid @error('slug') is-invalid @enderror" id="slug" name="slug" type="text" placeholder="" value="{{ old('slug', $category->slug) }}" readonly />
                            @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="1" name="popular" id="flexCheckDefault" <?php if($category->popular) echo 'checked'; ?> />
                              <label class="form-check-label" for="flexCheckDefault">Popular</label>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a class="btn btn-danger" href="{{ route('categories.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: Category Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->

<script>
    // Slug Generator
    const title = document.querySelector("#name");
    const slug = document.querySelector("#slug");
    title.addEventListener("keyup", function() {
        let preslug = title.value;
        preslug = preslug.replace(/ /g,"-");
        slug.value = preslug.toLowerCase();
    });
</script>
@endsection
