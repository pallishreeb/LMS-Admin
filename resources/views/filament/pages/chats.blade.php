<x-filament-panels::page>
    <div class="flex space-x-4">
        <!-- User List -->
        <div class="flex flex-col items-start space-y-4">
            <div class="font-bold text-lg mb-2">User List</div>
            @foreach($data->unique('user_id') as $message)
                <button wire:click="navigateToUser({{ $message->user->id }})" class="text-blue-500 cursor-pointer">{{ $message->user->name }}</button>
            @endforeach
        </div>
    </div>
</x-filament-panels::page>
