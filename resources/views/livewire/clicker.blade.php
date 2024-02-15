<div>
    <form wire:submit="createNewUser" action="">
        <input class="block border-2 border-gray-400" wire:model="name" type="text" name="name" required>
        <input class="block border-2 border-gray-400 mt-2 w-75" wire:model="email" type="text" name="email" required>
        <input class="block border-2 border-gray-400 mt-2" wire:model="password" type="text" name="password" required>

        <button>create</button>
    </form>

    <hr>

    @if (session('success'))
        <h1>{{ session('success') }}</h1>
    @endif

    {{ $count }}

    @error('name')
        <h5>{{ $message }}</h5>
    @enderror

    @error('email')
        <h5>{{ $message }}</h5>
    @enderror

    @error('password')
        <h5>{{ $message }}</h5>
    @enderror

    @foreach ($users as $user)
        <p>{{ $user->name }}</p>
    @endforeach

    {{ $users->links() }}
</div>