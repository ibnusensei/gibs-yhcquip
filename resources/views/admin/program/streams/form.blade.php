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
                    <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
                        @if (@$streams)
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" id="name" class="form-control" name="name"
                                placeholder="Name of Streams, Ex: IPA" value="{{ old('name', @$streams->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" placeholder="Stream Description..." rows="4" required>{{ old('description', @$streams->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            @if (@$streams)
                                <img src=" {{ $streams->getFirstMediaUrl('images') }}"
                                    style="max-width: 100px; height: auto">
                            @endif
                            <label class="form-label" for="images">Add Image</label>
                            <input type="file" id="images" name="images" multiple class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- End Content -->

</x-app-layout>
