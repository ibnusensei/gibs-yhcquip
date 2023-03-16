<x-app-layout>

    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Career</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.career.index') }}">
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
                    <h4 class="mb-3 card-title">{{ @$career ? 'Edit' : 'Create' }} career</h4>
                    <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
                        @if (@$career)
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="posisi">Posisi</label>
                            <input type="text" id="posisi" class="form-control" name="posisi"
                                placeholder="Posisi" value="{{ @$career->posisi}}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="unit">Unit</label>
                            <input type="text" id="unit" class="form-control" name="unit"
                                placeholder="Unit" value="{{ @$career->unit}}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea id="editor" name="description" class="form-control" placeholder="Textarea field" rows="4">{{ @$career->description }}</textarea>
                        </div>

                        <!-- Flatpickr -->
                        <div class="mb-3">
                            <label class="form-label" for="start_date">start_date</label>
                            <input type="text" name="start_date" class="js-flatpickr form-control flatpickr-custom" placeholder="Select start_date" value="{{ @$career->start_date }}"
                            data-hs-flatpickr-options='{
                                "dateFormat": "d/m/Y"
                            }'>

                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="end_date">end_date</label>
                            <input type="text" name="end_date" class="js-flatpickr form-control flatpickr-custom" placeholder="Select end_date" value="{{ @$career->end_date }}"
                            data-hs-flatpickr-options='{
                                "dateFormat": "d/m/Y"
                            }'>

                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="image">Image</label>
                            <input type="file" id="image" name="image" class="form-control" onchange="previewImage(this);">
                        </div>
                        <div class="mb-3" id="preview">
                            @if (@$career && $career->hasMedia('image'))
                                <img src="{{ $career->getFirstMediaUrl('image', 'thumb') }}" alt="">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" value="1" name="delete_image" id="delete_image">
                                    <label class="form-check-label" for="delete_image">
                                        Delete existing image
                                    </label>
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview').html('<img src="' + e.target.result + '" alt="">');
                    $('#preview img').css('max-width', '300px'); // Add this line
                }
                reader.readAsDataURL(input.files[0]);
            }
        }


    </script>    
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
    
@endpush

@include('scripts.datepicker')

    <!-- End Content -->
</x-app-layout>
