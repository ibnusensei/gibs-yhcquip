<x-app-layout>
    <!-- Content -->
    @push('styles')
        <style>
            .img-custom {
                height: 200px !important;
                border-radius: 0.25rem
                    /* 4px */
                ;
                overflow: hidden;
            }

            .img-custom>img {
                background-size: cover;
                height: auto;
                width: 100%;
            }
        </style>
    @endpush
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Gallery</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.gallery.index') }}">
                        <i class="bi-chevron-left me-1"></i> Back
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <div class="card mb-3">
            <div class="card-body">
                <h4 class="card-title">Add Images</h4>
                <form action="{{ route('admin.gallery.image.store', $gallery) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="file" id="customFileEg1" name="images[]" multiple class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $gallery->name }}</h4>
                <p class="card-text">{{ $gallery->description }}</p>

                {{-- media --}}
                <div class="row ">
                    @foreach ($gallery->getMedia('images') as $image)
                        <div class="col-md-4 mb-4">
                            <div class="img-custom rounded mb-2">
                                <img src="{{ $image->getUrl() }}" class="" alt="">
                            </div>
                            <form action="{{ route('admin.gallery.image.destroy', $gallery) }}" method="POST" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger btn-sm delete-btn">Delete</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
    <!-- End Content -->
    @include('scripts.delete')

</x-app-layout>
