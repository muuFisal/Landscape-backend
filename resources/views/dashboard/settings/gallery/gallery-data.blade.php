<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('dashboard.image') }}</th>
                <th>{{ __('dashboard.title') }}</th>
                <th>{{ __('dashboard.sort-order') }}</th>
                <th>{{ __('dashboard.status') }}</th>
                <th>{{ __('dashboard.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ asset($item->image) }}" width="60" class="img-thumbnail">
                    </td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->sort_order }}</td>
                    <td>
                        <button type="button"
                            class="btn btn-sm {{ $item->status ? 'btn-success' : 'btn-warning' }}"
                            wire:click="updateStatus({{ $item->id }}, {{ $item->status ? 0 : 1 }})">
                            {{ $item->status ? __('dashboard.active') : __('dashboard.inactive') }}
                        </button>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <button type="button" class="btn btn-sm btn-primary" wire:click="$dispatchTo('dashboard.settings.gallery.gallery-update', 'editGalleryItem', { id: {{ $item->id }} })">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }})">
                                <i class="fa-solid fa-trash"></i>
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
    <div class="mt-1">
        {{ $data->links() }}
    </div>

    <script>
        function confirmDelete(id) {
            Livewire.dispatch('deleteItemConfirm', { id: id });
        }
    </script>
</div>
