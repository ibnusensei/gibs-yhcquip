<x-app-layout>
    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Streams</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.streams.index') }}">
                        <i class="bi-chevron-left me-1"></i> Back
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <div>
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3 card-title">{{ @$streams ? 'Edit' : 'Create' }} streams</h4>
                    <form action="{{ $url }}" method="POST">
                        @if (@$streams)
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" id="name" class="form-control" name="name"
                                placeholder="Name of streams" value="{{ @$streams->name }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" placeholder="Textarea field" rows="4">{{ @$streams->description }}</textarea>
                        </div>

                        {{-- <div class="mb-3">
                            <h4 class="card-title">Add Images</h4>
                <form action="{{ route('admin.streams.image.store', $streams) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input type="file" id="customFileEg1" name="images[]" multiple class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                </form>
                        </div> --}}

                        {{-- <div class="mb-3">
                            <label class="form-label" for="image">Image</label>
                            <input type="file" id="image" name="image" class="form-control" onchange="previewImage(this);">
                        </div>
                        <div class="mb-3" id="preview">
                            @if (@$streams && $streams ->hasMedia('images'))
                                <img src="{{ $streams->getFirstMediaUrl('images') }}" alt="">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" value="1" name="delete_images" id="delete_images">
                                    <label class="form-check-label" for="delete_images">
                                        Delete existing image
                                    </label>
                                </div>
                            @endif
                        </div> --}}

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- End Content -->

    @push('scripts')
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview').html('<img src="' + e.target.result + '" alt="">');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    @endpush
</x-app-layout>
