<h2>Edit User</h2>

@if ($errors->any())
    <ul style="color: red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT')

    <label>Name:</label>
    <input type="text" name="name" value="{{ old('name', $user->name) }}"><br><br>

    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email', $user->email) }}"><br><br>

    <label>Password (leave blank to keep current):</label>
    <input type="password" name="password"><br><br>

    <label>Active:</label>
    <input type="checkbox" name="active" {{ $user->active ? 'checked' : '' }}><br><br>

    <button type="submit">Update</button>
</form>
