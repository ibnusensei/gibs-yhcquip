<x-app-layout>

    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">information</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.information.index') }}">
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
                    <h4 class="mb-3 card-title">{{ @$information ? 'Edit' : 'Create' }} information</h4>
                    <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
                        @if (@$information)
                            @method('PUT')
                        @endif
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="title">title</label>
                            <input type="text" id="title" class="form-control" name="title"
                                placeholder="title" value="{{ @$information->title}}">
                        </div>
                        
                        {{-- <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" placeholder="Textarea field" rows="4">{{ @$information->description }}</textarea>
                        </div> --}}

                        
                        {{-- ckeditor description --}}

                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea id="editor" name="description" class="form-control" placeholder="Textarea field" rows="4">{{ @$information->description }}</textarea>
                        </div>

                        {{-- ckeditor description end --}}


                        <!-- Flatpickr -->
                        <div class="mb-3">
                            <label class="form-label" for="date">Date</label>
                            <input type="text" name="date" class="js-flatpickr form-control flatpickr-custom" placeholder="Select date" value="{{ @$event->date }}"
                            data-hs-flatpickr-options='{
                                "dateFormat": "d/m/Y"
                            }'>

                        </div>

                    
                        
                        
                        

                        <div class="mb-3">
                            <label class="form-label" for="image">Image</label>
                            <input type="file" id="image" name="image" class="form-control" onchange="previewImage(this);">
                        </div>
                        <div class="mb-3" id="preview">
                            @if (@$information && $information->hasMedia('image'))
                                <img src="{{ $information->getFirstMediaUrl('image', 'thumb') }}" alt="">
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
