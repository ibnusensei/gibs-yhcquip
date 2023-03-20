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
                            <label class="form-label" for="achiev">Achievement</label>
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


                        {{-- <div class="mb-2">
                            <label class="form-label" for="name">Gainer</label>
                            <input type="text" id="name" class="form-control mb-1" name="name[]"
                                placeholder="Name" value="{{ @$achievement->gainer->name }}">
                            <input type="text" id="from" class="form-control" name="from[]"
                                placeholder="From" value="{{ @$achievement->gainer->from }}">
                        </div>
                        <div class="form mb-5">
                            <a href="#" class="addgainer" style="float: right;">
                                Add Gainer
                            </a>
                        </div>

                        <div class="gainer">

                        </div> --}}

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Gainer</label>
                            <div class="col-sm-10">
                                <a href="javascript:;" class="addGainer form-link mb-2"><i class="bi-plus-circle me-1"></i>Add Gainer</a>
                            </div>
                        </div>

                        @foreach ($achievement->gainer as $gainer)
                        <div>
                        <div class="form-group row mb-1">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name[]" value="{{ @$gainer->name }}"placeholder="Enter Name" required>
                            </div>
                            <div class="col-sm-1">
                                <a href="javascript:;" class="remove link-danger" style="float:right;">
                                    <i class="bi-x-circle"></i>
                                </a>
                            </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-9"><input type="text" class="form-control" name="from[]" value="{{ @$gainer->from }}"placeholder="From ..." required>
                        </div>

                    </div>
                </div>
                        @endforeach

                        <div class="gainer"></div>

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
    {{-- @push('scripts')
    <script src="{{asset('dist')}}/assets/vendor/hs-add-field/dist/hs-add-field.min.js"></script>
    <script>
        (function() {
          // INITIALIZATION OF ADD FIELD
          // =======================================================
          new HSAddField('.js-add-field')
        })()
      </script>
    @endpush --}}

    {{-- @push('scripts')
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
        <script type="text/javascript">
            $('.addgainer').on('click', function(){
                addgainer();
            });
            function addgainer(){
                var gainer = '<div><div><div><input type="text" id="name" class="form-control mb-1" name="name[]" placeholder="Name" value="{{ @$achievement->gainer->name }}"> <input type="text" id="from" class="form-control" name="from[]" placeholder="From" value="{{ @$achievement->gainer->from }}"></div></div></div.';
                $('.gainer').append(gainer);
            };
            $('.remove').live('click', funtion(){
                $(this).parent().parent().parent().remove();
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    @endpush --}}

    @push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script type="text/javascript">
        $('.addGainer').on('click', function() {
            addGainer();
        });
        // <a href="#" class="remove btn btn-danger" style="float: right;">Hapus</a>
        function addGainer() {
            var gainer = '<div><div class="form-group row mb-1"><label class="col-sm-2 col-form-label"></label><div class="col-sm-9"><input type="text" class="form-control" name="name[]" value="{{ @$achievements->gainer->name }}"placeholder="Enter Name" required></div><div class="col-sm-1"><a href="javascript:;" class="remove link-danger" style="float:right;"><i class="bi-x-circle"></i></a></div></div><div class="form-group row mb-3"><label class="col-sm-2 col-form-label"></label><div class="col-sm-9"><input type="text" class="form-control" name="from[]" value="{{ @$achievements->gainer->from }}"placeholder="From ..." required></div></div></div>'
        $('.gainer').append(gainer);
        };
        $('.remove').live('click', function() {
            $(this).parent().parent().parent().remove();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    @endpush

</x-app-layout>
