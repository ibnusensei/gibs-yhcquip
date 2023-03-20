<x-app-layout>
    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Program Unggulan</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.unggulan.index') }}">
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
                    <h4 class="mb-3 card-title">{{ @$unggulan ? 'Edit' : 'Create' }} Program Unggulan</h4>
                    <form action="{{ $url }}" method="POST">
                        @if (@$unggulan)
                            @method('PUT')
                        @endif
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="title">Title</label>
                            <input type="text" id="title" class="form-control" name="title"
                                placeholder="Title of Program, Ex: Tadarus" value="{{ old('title', @$unggulan->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="superiority">Keunggulan</label>
                            <textarea id="superiority" name="superiority" class="form-control" placeholder="Program Superiority..." rows="4" required>{{ old('superiority', @$unggulan->superiority) }}</textarea>
                            </div>

                        <div class="mb-3">
                            <label for="program_category_id" class="form-label">Program Category</label>
                            <select name="program_category_id" class="form-control">
                                <option value="">- Silahkan Pilih -</option>
                                @foreach ($program_categories as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('program_category_id', @$unggulan->program_category_id) == $item->id ? 'selected' : '' }}> {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('program_category_id')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                         </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- End Content -->
</x-app-layout>
