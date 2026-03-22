@extends('dashboard.master', ['title' => __('dashboard.home')])
@section('dashboard-active', 'active')
@section('content')
    <section id="dashboard-ecommerce">
        <div class="row match-height">
            <div class="col-12">
                <div class="card card-statistics">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('dashboard.statistics') }}</h4>
                        <div class="d-flex align-items-center">
                            <p class="card-text font-small-2 me-25 mb-0">
                                {{ __('dashboard.as-of') }} {{ $asOf->translatedFormat('d M Y - h:i A') }}
                            </p>
                        </div>
                    </div>
                    <div class="card-body statistics-body">
                        <div class="row">
                            @foreach ($stats as $stat)
                                <div class="col-xl-3 col-md-4 col-sm-6 col-12 mb-2">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-{{ $stat['color'] }} me-2">
                                            <div class="avatar-content">
                                                <i class="avatar-icon {{ $stat['icon'] }}"></i>
                                            </div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">{{ number_format($stat['count']) }}</h4>
                                            <p class="card-text font-small-3 mb-0">
                                                {{ __('dashboard.' . $stat['label']) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row match-height">
            <div class="col-xl-6 col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">{{ __('dashboard.latest-contacts') }}</h4>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('dashboard.name') }}</th>
                                        <th>{{ __('dashboard.email') }}</th>
                                        <th>{{ __('dashboard.phone') }}</th>
                                        <th>{{ __('dashboard.subject') }}</th>
                                        <th>{{ __('dashboard.created-at') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($latestContacts as $contact)
                                        <tr>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->phone }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($contact->subject, 40) }}</td>
                                            <td>{{ $contact->created_at?->translatedFormat('d M Y - h:i A') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">{{ __('dashboard.no-data') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">{{ __('dashboard.latest-projects') }}</h4>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('dashboard.title') }}</th>
                                        <th>{{ __('dashboard.service') }}</th>
                                        <th>{{ __('dashboard.year') }}</th>
                                        <th>{{ __('dashboard.status') }}</th>
                                        <th>{{ __('dashboard.created-at') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($latestProjects as $project)
                                        <tr>
                                            <td>{{ $project->title }}</td>
                                            <td>{{ $project->service?->title ?? __('dashboard.not-available') }}</td>
                                            <td>{{ $project->year ?: __('dashboard.not-available') }}</td>
                                            <td>
                                                <span class="badge bg-{{ $project->status ? 'success' : 'secondary' }}">
                                                    {{ $project->status ? __('dashboard.active') : __('dashboard.inactive') }}
                                                </span>
                                            </td>
                                            <td>{{ $project->created_at?->translatedFormat('d M Y - h:i A') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">{{ __('dashboard.no-data') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">{{ __('dashboard.projects-by-service') }}</h4>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('dashboard.service') }}</th>
                                        <th>{{ __('dashboard.count') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($projectsByService as $service)
                                        <tr>
                                            <td>{{ $service->title }}</td>
                                            <td>{{ number_format($service->projects_count) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center">{{ __('dashboard.no-data') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
