<div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('dashboard.title') }}</th>
                    <th>{{ __('dashboard.service') }}</th>
                    <th>{{ __('dashboard.year') }}</th>
                    <th>{{ __('dashboard.status') }}</th>
                    <th>{{ __('dashboard.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->service->title ?? 'N/A' }}</td>
                        <td>{{ $item->year }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" wire:click="updateStatus({{ $item->id }})" {{ $item->status ? 'checked' : '' }}>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-outline-primary" wire:click="$dispatch('editProject', { id: {{ $item->id }} })">
                                    <i data-feather="edit-2"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger" wire:click="$dispatch('deleteItem', { id: {{ $item->id }} })">
                                    <i data-feather="trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">{{ __('dashboard.no-data') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-2">
        {{ $projects->links() }}
    </div>
</div>
