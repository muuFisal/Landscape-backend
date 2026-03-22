<?php

namespace App\Livewire\Dashboard\Contacts;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class ContactData extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshData' => '$refresh', 'deleteItem'];

    public string $search = '';

    public array $selectedContact = [];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function showMessage(int $id): void
    {
        $contact = Contact::findOrFail($id);

        $this->selectedContact = [
            'id' => $contact->id,
            'name' => $contact->name,
            'email' => $contact->email,
            'phone' => $contact->phone,
            'subject' => $contact->subject,
            'message' => $contact->message,
            'created_at' => $contact->created_at?->translatedFormat('d M Y - h:i A'),
        ];

        $this->dispatch('open-contact-message-modal');
    }

    public function deleteItem($id): void
    {

        if (!$id) {
            return;
        }

        $contact = Contact::find($id);

        if (!$contact) {
            return;
        }

        $contact->delete();

        if (($this->selectedContact['id'] ?? null) === (int) $id) {
            $this->reset('selectedContact');
            $this->dispatch('close-contact-message-modal');
        }

        $this->dispatch('itemDeleted');
    }

    public function render()
    {
        $search = trim($this->search);

        $data = Contact::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($innerQuery) use ($search) {
                    $innerQuery->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('subject', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate(10);

        return view('dashboard.contacts.contact-data', compact('data'));
    }
}
