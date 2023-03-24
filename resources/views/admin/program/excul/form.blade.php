<x-app-layout>
    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Excule</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.excul.index') }}">
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
                    <h4 class="mb-3 card-title">{{ @$exculs ? 'Edit' : 'Create' }} Excule</h4>
                    <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
                        @if (@$exculs)
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" id="name" class="form-control" name="name"
                                placeholder="Name of Excule, Ex: Pramuka " value="{{ old('name', @$exculs->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" placeholder="Excule Description..." rows="4" required>{{ old('description', @$exculs->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            @if (@$exculs)
                                <img src=" {{ $exculs->getFirstMediaUrl('images') }}"
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
