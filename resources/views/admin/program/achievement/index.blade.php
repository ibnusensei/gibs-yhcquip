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

            {{-- <div class="col d-md-flex align-items-md-center text-center">
                <span class="d-block me-md-3 mb-2 mb-md-1">Level:</span>
                <a class="btn btn-soft-secondary btn-xs rounded-pill m-1" href="javascript:;">SMP</a>
                <a class="btn btn-soft-secondary btn-xs rounded-pill m-1" href="javascript:;">SMA</a>
              </div> --}}

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
                    {{-- <span class="input-group-prepend input-group-text">
                        <i class="bi-search"></i>
                      </span> --}}
                    <input type="text" class="form-control" placeholder="Search for Title ..." aria-label="Search" name="search" value="{{ @$_GET['search'] }}">
                    <button class="btn btn-warning"><i class="bi-search"><a href="{{ @$_GET['search'] }}"></a></i></button>
                  </div>
                  <!-- End Input Card -->

              </div>

              {{-- <div class="d-md-flex input-group">
                <input type="text" class="form-control ms-10" placeholder="Search articles" aria-label="Search articles" name="search" value="{{ @$_GET['search'] }}">

                    <button class="btn btn-warning">
                        <i class="bi-search"><a href="{{ @$_GET['search'] }}"></a></i>
                    </button>
              </div> --}}

              {{-- <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ @$_GET['search'] }}">
            </div>
            <div class="col-md-5">
                <a href="{{ @$_GET['search'] }}">
                    <button class="btn btn-warning">
                        <i class="bi-search"></i>
                    </button>
                </a>
            </div> --}}

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
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" id="formSwitch1">
                                            <label class="form-check-label" for="formSwitch1"></label>
                                          </div>
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
                                    <td colspan="3" class="text-center">No Data</td>
                                    {{-- <div class="col-auto"> --}}
                                        {{-- <a class="btn btn-primary" href="{{ route('admin.achievement.index') }}">
                                            <i class="bi-chevron-left me-1"></i> Back
                                        </a> --}}
                                    {{-- </div> --}}
                                    <!-- End Col -->
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- {{ $achievement->withQueryString()->links()}} --}}
        </div>
            {{ $achievements->withQueryString()->links()}}

    </div>
    <!-- End Content -->

    @include('scripts.delete')
</x-app-layout>
