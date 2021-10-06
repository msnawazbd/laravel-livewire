<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Ticket extends Component
{

    public $active_id;

    protected $listeners = [
        'ticket_selected' => 'ticket_selected' // or 'ticket_selected' if function name and event same
    ];

    public function ticket_selected($ticket_id)
    {
        $this->active_id = $ticket_id;
    }

    public function render()
    {
        $tickets = \App\Models\Ticket::with([
            'user_info'
        ])->latest()->get();
        return view('livewire.ticket', ['tickets' => $tickets]);
    }
}
