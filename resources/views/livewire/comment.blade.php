<section>
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div wire:offline>
                You are now offline.
            </div>
            <div class="text-primary mb-1" wire:loading wire:target="s_comment">
                Processing...
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-primary mb-1" wire:loading wire:target="add_comment">
                Adding...
            </div>
            <form wire:submit.prevent="add_comment">
                <!-- flash message -->
                <div>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
                <div>
                    @if (session()->has('error'))
                        <div class="alert alert-warning">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>

                <!-- input field -->
                <div class="input-group is-invalid mb-3">
                    <input type="text" wire:model="n_comment" class="form-control" placeholder="Enter your message">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Add</button>
                    </div>
                </div>

                <!-- validation message -->
                <div class="invalid-feedback">
                    @error('n_comment') <span class="error">{{ $message }}</span> @enderror
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <form wire:submit.prevent="search_comment">
                <!-- search field -->
                <div class="input-group is-invalid mb-3">
                    <input type="text" wire:model="s_comment" class="form-control" placeholder="Enter your message">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-6 text-left">
            @foreach($comments as $comment)
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title">{{ $comment->user_info->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</h6>
                        <p class="card-text">{{ $comment->message }}</p>
                    </div>
                    <div class="card-footer">
                        <button wire:click="remove_comment({{ $comment->id }})"
                                class="btn btn-danger btn-sm float-right">Delete
                        </button>
                    </div>
                </div>
            @endforeach
            <div>
                {{ $comments->links() }}
            </div>
        </div>
    </div>
</section>
