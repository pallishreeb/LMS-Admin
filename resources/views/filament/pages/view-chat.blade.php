

<x-filament::page>
    <div>
        <h1>Chat Messages</h1>

        <div>

                <p>{{ $this->record->user->name }}: {{ $this->record->message }}</p>
                <hr>

        </div>

        <form method="post" action="/">
            @csrf
            <label for="message">Reply:</label>
            <textarea name="message" id="message" required></textarea>
            <button type="submit">Send Reply</button>
        </form>
    </div>
</x-filament::page>
