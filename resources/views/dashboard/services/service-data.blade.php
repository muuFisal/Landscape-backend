<div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('dashboard.image') }}</th>
                    <th>{{ __('dashboard.title') }}</th>
                    <th>{{ __('dashboard.slug') }}</th>
                    <th>{{ __('dashboard.has_projects') }}</th>
                    <th>{{ __('dashboard.show_in_projects_filter') }}</th>
                    <th>{{ __('dashboard.status') }}</th>
                    <th>{{ __('dashboard.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ asset($item->image) }}" width="50" class="rounded">
                        </td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>
                            @if($item->has_projects)
                                <span class="badge bg-success">{{ __('dashboard.yes') }}</span>
                            @else
                                <span class="badge bg-secondary">{{ __('dashboard.no') }}</span>
                            @endif
                        </td>
                        <td>
                            @if($item->show_in_projects_filter)
                                <span class="badge bg-info">{{ __('dashboard.visible') }}</span>
                            @else
                                <span class="badge bg-secondary">{{ __('dashboard.hidden') }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" wire:click="updateStatus({{ $item->id }})" {{ $item->status ? 'checked' : '' }}>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-outline-primary" wire:click="$dispatchTo('dashboard.services.service-update', 'editService', { id: {{ $item->id }} })">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger" wire:click="$dispatch('deleteItem', { id: {{ $item->id }} })">
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
        {{ $services->links() }}
    </div>
</div>
