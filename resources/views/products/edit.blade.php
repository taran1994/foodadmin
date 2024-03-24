@extends('dashboard.body.main')

@section('specificpagescripts')
<script src="{{ asset('assets/js/img-preview.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.add-variant').click(function(){
            $('.append-new:last').after('<div class="row gx-3 mb-3 append-new">   <div class="col-md-5"> <label class="small mb-1" for="category_id">Variant Name<span class="text-danger">*</span></label>              <input type="text" class="form-control" name="variant[]"> </div>   <div class="col-md-5">   <label class="small mb-1" for="selling_price">Price <span class="text-danger">*</span></label>                         <input type="text" class="form-control" name="variantprice[]">    </div>        <div class="col-md-2">            <label class="small mb-1" for="selling_price"> <span class="text-danger"></span></label><br> <a href="javascript:void(0);" class="btn btn-danger delete-variant">Remove</a>     </div> </div>');
        });
        $(document).on("click",".delete-variant",function() {
            $(this).parents('.append-new').remove();
        });
    })
</script>
@endsection


@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                        Edit Product
                    </h1>
                </div>
            </div>

            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-2 mt-n10">
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-xl-4">
                <!-- Product image card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Product Image</div>
                    <div class="card-body text-center">
                        <!-- Product image -->
                        <img style="width:100%"  class="img-account-profile mb-2" src="{{ $product->product_image ? asset('storage/products/'.$product->product_image) : asset('assets/img/products/default.webp') }}" alt="" id="image-preview" />
                        <!-- Product image help block -->
                        <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 2 MB</div>
                        <!-- Product image input -->
                        <input class="form-control form-control-solid mb-2 @error('product_image') is-invalid @enderror" type="file"  id="image" name="product_image" accept="image/*" onchange="previewImage();">
                        @error('product_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <!-- BEGIN: Product Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        Product Details
                    </div>
                    <div class="card-body">
                        <!-- Form Group (product name) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="product_name">Product name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid @error('product_name') is-invalid @enderror" id="product_name" name="product_name" type="text" placeholder="" value="{{ old('product_name', $product->product_name) }}" autocomplete="off"/>
                            @error('product_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- Form Row -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (type of product category) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="category_id">Product category <span class="text-danger">*</span></label>
                                <select class="form-select form-control-solid @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                    <option selected="" disabled="">Select a category:</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if(old('category_id', $product->category_id) == $category->id) selected="selected" @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <!-- Form Group (type of product unit) -->
                            <div class="col-md-6">
                                <label class="small mb-1" for="selling_price">Price <span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid @error('selling_price') is-invalid @enderror" id="selling_price" name="selling_price" type="text" placeholder="" value="{{ old('selling_price', $product->selling_price) }}" autocomplete="off" />
                                @error('selling_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- Form Row -->
                        
                        <!-- Form Group (stock) -->
                        <div class="mb-3">
                            <label class="small mb-1" for="stock">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control form-control-solid @error('description') is-invalid @enderror" name="description">{{ old('description', $product->description) }}</textarea>
                          
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $description ?? '' }}
                            </div>
                            @enderror
                        </div>
                         <div class="mb-3">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="1" name="recommend" id="flexCheckDefault" <?php if($product->recommend) echo 'checked'; ?> />
                              <label class="form-check-label" for="flexCheckDefault">Recommend</label>
                            </div>
                        </div>

                        <div class="mb-3 append-new">
                            <label class="small mb-1" for="stock">Product Variation <span class="text-danger">*</span></label>
                            <a href="javascript:void(0);" class="btn btn-primary pull-right add-variant">Add +</a>
                        </div>
                         @if ($variants->count())
                            @foreach ($variants as $value)
                            <div class="row gx-3 mb-3 append-new">
                               <div class="col-md-5"> 
                                <label class="small mb-1" for="category_id">Variant Name<span class="text-danger">*</span></label>
                                  <input type="text" class="form-control" name="variant[]" value="{{ $value->variant_name }}"> 
                              </div>  
                               <div class="col-md-5"> 
                                 <label class="small mb-1" for="selling_price">Price <span class="text-danger">*</span></label>         
                                 <input type="text" class="form-control" name="variantprice[]" value="{{ $value->variant_price }}"> 
                                </div>        
                                <div class="col-md-2"> 
                                    <label class="small mb-1" for="selling_price"> <span class="text-danger"></span></label><br>
                                    <a href="javascript:void(0);" class="btn btn-danger delete-variant">Remove</a>     
                                </div> 
                            </div>
                            @endforeach
                         @endif
                        
                        <!-- Submit button -->
                        <button class="btn btn-primary" type="submit">Update</button>

                        <a class="btn btn-danger" href="{{ route('products.index') }}">Cancel</a>
                    </div>
                </div>
                <!-- END: Product Details -->
            </div>
        </div>
    </form>
</div>
<!-- END: Main Page Content -->

@endsection
