<div>
    <form wire:submit.prevent="store">
        <input type="text" wire:model="title" required>
        <textarea wire:model="description"></textarea>
        <button>Save</button>
    </form>
</div>
