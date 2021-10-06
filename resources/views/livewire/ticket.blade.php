<section>
    <div class="row">
        <div class="col-md-12">
            <!-- left side -->
            @foreach($tickets as $key => $ticket)
                <div class="card mb-2 {{ $active_id == $ticket->id ? 'bg-primary' : '' }}" wire:click="$emit('ticket_selected', {{ $ticket->id }})">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted text-black-50">{{ $ticket->user_info->name }}</h6>
                        <p class="card-text">{{ $ticket->ticket_name }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
