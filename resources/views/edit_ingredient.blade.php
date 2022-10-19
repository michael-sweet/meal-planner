<form method="post">
    @csrf
    <div>
        <label>Name<label>
        <input type="text" name="name" value="{{ $ingredient->name }}" />
    </div>
    <button type="submit">Save</button>
</form>
