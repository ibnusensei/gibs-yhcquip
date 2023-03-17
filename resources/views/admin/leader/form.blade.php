<x-app-layout>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Leader</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.leader.index') }}">
                        <i class="bi-chevron-left me-1"></i> Back
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <div class="card">
            <form action="{{ $url }}" method="post">
                @csrf
                @if (@$leader)
                    @method('put')
                @endif
            <div class="card-body">
                    <h3 class="mb-3 card-title">{{ @$leader ? 'Edit' : 'Create' }} Leader</h3>
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold fs-5">Name Leader</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="inputkan name" value="{{ old('name', $leader->name) }}" >
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label fw-bold fs-5">Position Leader</label>
                        <input type="text" name="position" id="position" class="form-control" value="{{ old ('position', $leader->position) }}"  placeholder="inputkan position">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="sumbit" class="btn btn-success">
                        <i class="bi bi-save"></i>
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>