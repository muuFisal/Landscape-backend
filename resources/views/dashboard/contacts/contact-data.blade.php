<div>
    <div class="row mb-1">
        <div class="col-md-4 col-12">
            <input type="text" wire:model.live.debounce.300ms="search" class="form-control"
                placeholder="{{ __('dashboard.search-here') }}">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>{{ __('dashboard.id') }}</th>
                    <th>{{ __('dashboard.name') }}</th>
                    <th>{{ __('dashboard.email') }}</th>
                    <th>{{ __('dashboard.phone') }}</th>
                    <th>{{ __('dashboard.subject') }}</th>
                    <th>{{ __('dashboard.message-preview') }}</th>
                    <th>{{ __('dashboard.created-at') }}</th>
                    <th>{{ __('dashboard.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($item->subject, 40) }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($item->message, 60) }}</td>
                        <td>{{ $item->created_at?->translatedFormat('d M Y - h:i A') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-outline-info"
                                    wire:click="showMessage({{ $item->id }})"
                                    title="{{ __('dashboard.view-message') }}">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger"
                                    wire:click="$dispatch('contactDelete', { id: {{ $item->id }} })"
                                    title="{{ __('dashboard.delete') }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">{{ __('dashboard.no-data') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-2">
        {{ $data->links() }}
    </div>

    <div class="modal fade text-start" id="showModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('dashboard.view-message') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="{{ __('dashboard.close') }}"></button>
                </div>
                <div class="modal-body">
                    @if ($selectedContact)
                        <div class="row g-1">
                            <div class="col-md-6 col-12">
                                <label class="form-label">{{ __('dashboard.name') }}</label>
                                <div class="border rounded p-1">{{ $selectedContact['name'] ?? __('dashboard.not-available') }}
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="form-label">{{ __('dashboard.email') }}</label>
                                <div class="border rounded p-1">{{ $selectedContact['email'] ?? __('dashboard.not-available') }}
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="form-label">{{ __('dashboard.phone') }}</label>
                                <div class="border rounded p-1">{{ $selectedContact['phone'] ?? __('dashboard.not-available') }}
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="form-label">{{ __('dashboard.created-at') }}</label>
                                <div class="border rounded p-1">
                                    {{ $selectedContact['created_at'] ?? __('dashboard.not-available') }}
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">{{ __('dashboard.subject') }}</label>
                                <div class="border rounded p-1">{{ $selectedContact['subject'] ?? __('dashboard.not-available') }}
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">{{ __('dashboard.full-message') }}</label>
                                <div class="border rounded p-1 bg-light">
                                    {!! nl2br(e($selectedContact['message'] ?? __('dashboard.not-available'))) !!}
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="mb-0 text-center">{{ __('dashboard.no-data') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
