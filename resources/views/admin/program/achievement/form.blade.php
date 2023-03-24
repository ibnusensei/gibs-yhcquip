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
                    <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
                        @if (@$achievement)
                            @method('PUT')
                        @endif
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="achiev">Achievement</label>
                            <input type="text" id="achiev" class="form-control" name="achiev"
                                placeholder="Enter Achievement, Ex: Juara 1" value="{{ old('achiev', @$achievement->achiev) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="title">Title</label>
                            <input type="text" id="title" class="form-control" name="title"
                                placeholder="Title of Achievement, Ex: Lomba Nyanyi" value="{{ old ('title',@$achievement->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="location">Location</label>
                            <input type="text" id="location" class="form-control" name="location"
                                placeholder="Location..., Ex: GIBS" value="{{ old('location', @$achievement->location) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="year">Year</label>
                            <input type="year" id="year" class="form-control" name="year"
                                placeholder="Enter Only Year, Ex: 2023" value="{{ old('year', @$achievement->year) }}" required>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Gainer</label>
                            <div class="col-sm-10">
                                <a href="javascript:;" class="addGainer form-link mb-2"><i class="bi-plus-circle me-1"></i>Add Gainer</a>
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label class="col-sm-2 col-form-label text-end">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name[]" value="{{ old('name', @$achievement->gainer->name) }}"
                                    placeholder="Enter Name, Ex: Fulan" required>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-sm-2 col-form-label text-end">From</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="from[]" value="{{old('from', @$achievement->gainer->from)}}"
                                    placeholder="From..., Ex: Jakarta" required>
                            </div>

                        </div>


                        <div class="gainer"></div>



                            <div class="mb-3">
                                @if (@$achievement)
                                    <img src=" {{ $achievement->getFirstMediaUrl('images') }}"
                                        style="max-width: 100px; height: auto">
                                @endif
                                <label class="form-label" for="images">Add Image</label>
                                <input type="file" id="images" name="images" multiple class="form-control">
                            </div>


                        <div class="mb-3">
                            <label for="level_id" class="form-label">Level</label>
                            <select name="level_id" class="form-control">
                                <option value="">- Silahkan Pilih -</option>
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
    @include('scripts.gainer')



</x-app-layout>
