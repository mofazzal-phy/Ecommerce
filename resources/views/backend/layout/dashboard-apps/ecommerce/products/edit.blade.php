@extends('backend.app')
@push('style')
@endpush

@section('content')

    <div class="main-content">

        <div class="container container-fluid" style="margin-top: 5rem; margin-bottom: 5rem;">

            <form action="{{ route('products.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <!-- Product Title -->
                <label for="for title">Product Title</label>
                <input type="text" name="title" value="{{ old('title', $product->title) }}" class="form-control mb-2"
                    placeholder="Product Title">

                <!-- Category (text based, table নেই বলেছো) -->
                <label for="category">Category</label>
                <input type="text" name="category" value="{{ old('category', $product->category) }}"
                    class="form-control mb-2" placeholder="Category name">

                <!-- Price -->
                <label for="price">Price</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" class="form-control mb-2"
                    placeholder="Price">

                <!-- Stock -->
                <label for="stock">Stock Quantity</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="form-control mb-2"
                    placeholder="Stock Quantity">

                {{-- status --}}
                <label for="status">Status</label>
                <select name="status" class="form-control mb-2">
                    <option value="published" {{ old('status', $product->status) == 'published' ? 'selected' : '' }}>
                        Published</option>
                    <option value="draft" {{ old('status', $product->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="hidden"{{ old('status', $product->status) == 'hidden' ? 'selected' : '' }}>Hidden</option>
                </select>

                <!-- Main Image -->
                <label>Main Image</label>

                @if ($product->image)
                    <div class="mb-2">
                        <img src="{{ asset('uploads/products/' . $product->image) }}" width="120" class="img-thumbnail">
                    </div>
                @endif

                <input type="file" name="image" class="form-control mb-3">

                <!-- Gallery Images -->
<!-- Gallery Images -->
<label>Gallery Images</label>

@if ($product->gallery_image)
    @php
        // যদি gallery_image empty বা null হয়, তাহলে empty array হবে
        $galleryImages = json_decode($product->gallery_image, true) ?: [];
    @endphp

    <div class="mb-2 d-flex gap-2 flex-wrap">
        @foreach ($galleryImages as $gallery)
            <img src="{{ asset('uploads/products/gallery/' . $gallery) }}" width="100"
                 class="img-thumbnail">
        @endforeach
    </div>
@endif

<input type="file" name="gallery_image[]" multiple class="form-control">




                <button type="submit" class="btn btn-primary">
                    Update Product
                </button>

            </form>
        </div>
    </div>

@endsection
@push('script')
@endpush
