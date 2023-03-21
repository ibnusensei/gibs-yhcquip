<x-app-layout>
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Event</h1>
                </div>

                <div class="col-auto">
                    <a class="btn btn-primary" href="{{ route('admin.event.index') }}">
                        <i class="bi-chevron-left me-1"></i> Back
                    </a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $event->title }}</h4>
                <p class="card-text">{{ $event->description }}</p>
                <img src=" {{ $event->getFirstMediaUrl('images') }}" style="max-width: 500px; height: auto">
            </div>
        </div>
    </div>
</x-app-layout>
