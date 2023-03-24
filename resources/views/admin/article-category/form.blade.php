<x-app-layout>
  <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Article Category</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.article-category.index') }}">
                        <i class="bi-chevron-left me-1"></i> Back
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <div>
            <h4 class="mb-4 card-title">Create Article</h4>
            <div class="card">
                <div class="card-body shadow-lg">

                    <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
                        {{--  @if (@$category)
                            @method('PUT')
                        @endif  --}}
                        @csrf
                        <div class="mb-4">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" id="name" class="form-control" name="name"
                                placeholder="Name of Article Category" value="">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- End Content -->
</x-app-layout>