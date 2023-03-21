<x-app-layout>
    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Event</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.event.index') }}">
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
                    <h4 class="mb-3 card-title">{{ @$event ? 'Edit' : 'Create' }} Event</h4>
                    <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                        @if (@$event)
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ @$event->title }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            {{-- <input type="text" name="description" id="description" class="form-control"
                                value="{{ @$event->description }}"> --}}
                            <textarea id="description" name="description" class="form-control" rows="4">{{ @$event->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <div class="mb-3">
                                @if (@$event)
                                    <img src=" {{ $event->getFirstMediaUrl('images') }}"
                                        style="max-width: 100px; height: auto">
                                @endif
                                <label class="form-label" for="image">Choose Image</label>
                                <input type="file" id="image" name="images" multiple class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <input id="is_published" type="checkbox" @checked(@$event->is_published)>
                            <label for="is_published">Publish Event?</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
</x-app-layout>
