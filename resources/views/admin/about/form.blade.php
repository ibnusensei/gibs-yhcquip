<x-app-layout>
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row aligns-items-center">
                <div class="col">
                    <h1 class="page-header-title">About</h1>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.about.index') }}" class="btn btn-primary">
                        <i class="bi-chevron-left me-1"></i> Back
                    </a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (@$about)
                        @method('put')
                    @endif
                <h2 class="mb-3 card-title">{{ @$about ? 'Edit' : 'Create' }} About</h2>
                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold fs-4">Title About</label>
                        <input type="text" name="title" id="title" class="form-control" autofocus placeholder="input about name" value="{{ old('title', @$about->title) }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold fs-4">Description About</label>
                        <textarea name="description" id="description"  rows="5" class="form-control">{{ @$about->description }}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="sumbit" class="btn btn-success">
                        <i class="bi-save"></i>
                        Save</button>
                    </div>
                </form>
        </div>
    </div>
</x-app-layout>