<section>
    <div class="row justify-content-center mt-5">
        <div class="col-md-4 text-center">
            <button class="btn btn-primary" wire:click="increment">+</button>
            <button class="btn btn-secondary">{{ $count }}</button>
            <button class="btn btn-primary" wire:click="decrement">-</button>
        </div>
    </div>
</section>
