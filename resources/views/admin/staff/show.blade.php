<x-app-layout>
    @push('styles')
        <style>
            .img-custom {
                height: 200px !important;
                border-radius: 0.25rem
                    /* 4px */
                ;
                overflow: hidden;
            }

            .img-custom>img {
                background-size: cover;
                height: auto;
                width: 100%;
            }
        </style>
    @endpush
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Staff</h1>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.staff.index') }}">
                        <i class="bi-chevron-left me-1"></i> Back
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <div class="card">
            <div class="card-body">
                <div class="card" style="max-width: 20rem;">
                    <img class="card-img-top" src="{{ $staff->getFirstMediaUrl('image', 'thumbs') }}" alt="Card image cap">
                    <div class="card-body">
                      <h3 class="card-title text-center">{{ $staff->name }}</h3>
                      <p class="card-text text-center">{{ $staff->position }}</p>
                      
                    </div>
                  </div>
            </div>
        </div>
    </div>
</x-app-layout>