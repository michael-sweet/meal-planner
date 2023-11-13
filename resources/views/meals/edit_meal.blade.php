<x-meal_layout :meal="$meal">
    @section('container_class', 'container__main--sm')

    <form method="post" enctype="multipart/form-data" class="m-0">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $meal->name) }}" class="form-control" />
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" rows="10" name="description" id="description">{{ old('description', $meal->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control" />
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary icon-link"><i class="fa-solid fa-floppy-disk"></i>Save</button>
            <a href="{{ $cancel_link }}" class="btn btn-secondary icon-link"><i class="fa-solid fa-xmark"></i>Cancel</a>
        </div>
    </form>
</x-meal_layout>
