<x-app-layout>
    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Academic</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.academic.index') }}">
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
                    <h4 class="mb-3 card-title">{{ @$academic ? 'Edit' : 'Create' }} Academic</h4>
                    <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
                        @if (@$academic)
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" id="name" class="form-control" name="name"
                                placeholder="Name of Academic" value="{{ @$academic->name }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" placeholder="Textarea field" rows="4">{{ @$academic->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <div class="mb-3">
                                <!-- @if (@$academic)
                                    <img src=" {{ $academic->getFirstMediaUrl('image') }}"
                                        style="max-width: 100px; height: auto">
                                @endif -->
                                <label class="form-label" for="image">Choose Image</label>
                                <input type="file" id="image" name="image" multiple class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <input name="is_published" type="checkbox" @checked(@$academic->is_published)>
                            <label for="is_published">Publish Academic?</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- End Content -->
</x-app-layout>
