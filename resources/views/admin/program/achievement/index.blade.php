<x-app-layout>
    @push('styles')

    @endpush

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
                     <a class="btn btn-primary" href="{{ route('admin.achievement.create') }}">
                        <i class="bi-plus me-1"></i> Create
                    </a>
                </div>

                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <form action="">
            {{-- level --}}
        <div class="row mb-3">

            <div class="col-md-3">
                <select name="level" class="form-select" onchange="form.submit()">
                    <option value="">Semua Jenjang</option>
                    @foreach ($levels as $item)
                        <option value="{{ $item->slug }}"
                            {{ @$_GET['level'] == $item->slug ? 'selected' : ''}}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            {{-- Searching --}}
            <div class="col-md-5 col-lg-5">

                  <!-- Input Card -->
                  <div class="input-group input-group-merge">

                    <input type="text" class="form-control" placeholder="Search for Title ..." aria-label="Search" name="search" value="{{ @$_GET['search'] }}">
                    <button class="btn btn-warning"><i class="bi-search"><a href="{{ @$_GET['search'] }}"></a></i></button>
                  </div>
                  <!-- End Input Card -->

              </div>



        </form>


        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h4 class="card-title">Data achievement</h4>
                <div class="table-responsive">
                    <table class="table table-thead-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>level</th>
                                <th>Author</th>
                                <th>Publish</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-align-middle">
                            @forelse ($achievements as $achievement)
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td scope="row">
                                        <span class="avatar avatar-sm avatar-circle">
                                            <img class="avatar-img" src="{{$achievement->getFirstMediaUrl('images')}}" alt="######">
                                          </span>

                                            {{ Str::limit($achievement->title , 33, '...') }}


                                    </td>
                                    <td>{{ $achievement->level->name }}</td>
                                    <td>{{ $achievement->user->name}}</td>
                                    <td>
                                        <form class="publishForm" action="{{ route('admin.achievement.publish', $achievement->id) }}" method="POST">
                                            @csrf
                                            <div class="form-check form-switch">
                                                <input class="form-check-input publishSwitch" type="checkbox" name="is_published" {{ $achievement->is_published ? 'checked' : '' }}>
                                                {{-- <label class="form-check-label" for="publishSwitch">{{ $achievement->is_published ? '' : '' }}</label> --}}
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <a name="" id="" class="btn btn-outline-primary btn-sm"
                                            href="{{ route('admin.achievement.edit', $achievement) }}">Edit</a>
                                        <a name="" id="" class="btn btn-outline-info btn-sm"
                                            href="{{ route('admin.achievement.show', $achievement) }}">Show</a>
                                        <form action="{{ route('admin.achievement.destroy', $achievement) }}" method="POST" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-outline-danger btn-sm delete-btn">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="55" class="text-center pt-5">No Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            {{ $achievements->withQueryString()->links()}}

    </div>
    <!-- End Content -->

    @include('scripts.publish')
    @include('scripts.delete')
</x-app-layout>
