<h3>Chat Panel</h3>

<div style="display: flex">
    <div style="width: 30%;">
        <ul>
            @foreach ($users as $user)
                <li>
                    <a href="/chat/user/{{ $user->id }}">{{ $user->phone_number }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    <div style="width: 70%;">
        @if (isset($activeUser))
            <form method="POST" action="/chat/send" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $activeUser->id }}">
                <input type="hidden" name="reply_to" id="reply_to_input">
                <textarea name="message" placeholder="Tulis pesan..."></textarea>
                <input type="file" name="attachment">
                <button type="submit">Kirim</button>
            </form>

            <hr>

            @foreach ($messages as $msg)
                <div style="margin-bottom: 10px;">
                    <strong>{{ $msg->sender_id == auth()->id() ? 'Anda' : 'Mereka' }}</strong>:
                    @if ($msg->reply_to)
                        <div style="background: #f0f0f0; padding: 5px; margin-bottom: 5px;">
                            Balasan ke: {{ $msg->repliedMessage->message ?? '[terhapus]' }}
                        </div>
                    @endif
                    {{ $msg->message }}

                    @if ($msg->attachment)
                        <br><a href="{{ asset('storage/' . $msg->attachment) }}" target="_blank">📎 Lampiran</a>
                    @endif

                    <button onclick="reply({{ $msg->id }})">Reply</button>
                </div>
            @endforeach
        @endif
    </div>
</div>

<script>
function reply(id) {
    document.getElementById('reply_to_input').value = id;
}
</script>
