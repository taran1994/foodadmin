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
                        Edit Site Configuration
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('config.index') }}">Site Config</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('config.update', $config->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-xl-4">
                <!-- Product image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Site Logo</div>
                    <div class="card-body text-center">
                        <!-- Product image -->
                        <img style="width:100%"  class="img-account-profile mb-2" src="{{ $config->logo ? asset('storage/logo/'.$config->logo) : asset('assets/img/products/default.webp') }}" alt="" id="image-preview" />
                        <!-- Product image help block -->
                        <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 2 MB</div>
                        <!-- Product image input -->
                        <input class="form-control form-control-solid mb-2 @error('image') is-invalid @enderror" type="file"  id="image" name="logo" accept="image/*" onchange="previewImage();">
                        @error('logo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <!-- BEGIN: Banner Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Site Details
                    </div>
                    <div class="card-body">
                        <!-- Form Group (name) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="name">Site Name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('name') is-invalid @enderror" id="name" name="name" type="text" placeholder="" value="{{ old('name', $config->name) }}" autocomplete="off" />
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- Form Group (slug) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="slug">Site Slug (non editable).</label>
                            <input class="form-control form-control-solid @error('slug') is-invalid @enderror" id="slug" name="slug" type="text" placeholder="" value="{{ old('slug', $config->slug) }}" readonly />
                            @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="phone">Phone <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('phone') is-invalid @enderror" id="phone" name="phone" type="text" placeholder="" value="{{ old('phone', $config->phone) }}" autocomplete="off" />
                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="email">Email <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="" value="{{ old('email', $config->email) }}" autocomplete="off" />
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                         <div class="mb-3">
                            <label class="small mb-1" for="hours">Opening hours <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('hours') is-invalid @enderror" id="hours" name="hours" type="text" placeholder="" value="{{ old('hours', $config->hours) }}" autocomplete="off" />
                            @error('hours')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="copyright">Copyright <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('copyright') is-invalid @enderror" id="copyright" name="copyright" type="text" placeholder="" value="{{ old('copyright', $config->copyright) }}" autocomplete="off" />
                            @error('copyright')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="address">Address </label>
                            <textarea class="form-control form-control-solid @error('address') is-invalid @enderror" name="address">{{ old('address', $config->address) }}</textarea>
                          
                            @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a class="btn btn-danger" href="{{ route('config.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: banner Details -->
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
