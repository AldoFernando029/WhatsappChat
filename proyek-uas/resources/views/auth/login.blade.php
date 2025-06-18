<form method="POST" action="/login">
    @csrf
    <input type="text" name="phone_number" placeholder="Nomor Telepon" required>
    <button type="submit">Masuk</button>
</form>
