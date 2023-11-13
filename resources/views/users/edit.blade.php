<x-layout>
    @section('container_class', 'container__main--sm')

    <form method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" />
        </div>
        <button type="submit" class="btn btn-primary icon-link"><i class="fa-solid fa-floppy-disk"></i>Save</button>
        <a href="/" class="btn btn-secondary icon-link"><i class="fa-solid fa-xmark"></i>Cancel</a>
    </form>
</x-layout>
