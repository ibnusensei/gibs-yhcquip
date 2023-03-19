<x-app-layout>
    @push('styles')
    @endpush

    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Edit News Category</h1>
                </div>
                <!-- End Col -->



                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <div class="card mb-3" style="max-width: 700px">
            <div class="card-body">
                <h4 class="card-title mb-3">Data News Category</h4>
                <form action="{{ route('admin.news-category.update', $data->id) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-lable">Name</label>
                        <input type="text" value="{{ $data->name }}" name="name" id="name"
                            class="form-control">
                    </div>
                    <button class="btn btn-primary btn-sm" type="submit">Update</button>
                    <img src="{{ $file->getFirstMediaUrl('news') }}" alt="" width="">
                </form>
            </div>
        </div>

    </div>
    <!-- End Content -->

</x-app-layout>
