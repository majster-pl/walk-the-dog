<div>
    <div class="d-flex flex-row mx-3 mb-2">
        <div>
            <span class="align-text-bottom me-1">
                <i class="text-success fa fa-heart{{ !$like ? '-o' : '' }} me-1" aria-hidden="true"></i>
                <span style="font-size: 0.85rem">
                    {{ $likes }}
                </span>
            </span>
        </div>
        <form action="#" wire:submit.prevent="likePlace">
                @csrf
                <button type="submit" style="position: relative; z-index:13" class="btn link-primary p-0 pe-1 text-decoration-underline">{{ $like ? 'Unlike' : 'Like'}}</button>
            </form>
    </div>
</div>
