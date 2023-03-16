<x-app-layout>
    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Achievement</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.achievement.index') }}">
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
                    <h4 class="mb-3 card-title">{{ @$achievement ? 'Edit' : 'Create' }} achievement</h4>
                    <form action="{{ $url }}" method="POST">
                        @if (@$achievement)
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="achiev">Achievment</label>
                            <input type="text" id="achiev" class="form-control" name="achiev"
                                placeholder="achievement" value="{{ @$achievement->achiev }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="title">Title</label>
                            <input type="text" id="title" class="form-control" name="title"
                                placeholder="Title of achievement" value="{{ @$achievement->title }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="location">Location</label>
                            <input type="text" id="location" class="form-control" name="location"
                                placeholder="Location" value="{{ @$achievement->location }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="year">Year</label>
                            <input type="year" id="year" class="form-control" name="year"
                                placeholder="Year" value="{{ @$achievement->year }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" id="name" class="form-control" name="name"
                                placeholder="Name" value="{{ @$achievement->name }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="from">From</label>
                            <input type="text" id="from" class="form-control" name="from"
                                placeholder="From" value="{{ @$achievement->from }}">
                        </div>

                        <div class="mb-3">
                            <label for="level_id" class="form-label">Level</label>
                            <select name="level_id" class="form-control">
                                <option value="">-Silahkan Pilih-</option>
                                @foreach ($levels as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('level_id', @$achievement->level_id) == $item->id ? 'selected' : '' }}> {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('level_id')
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
