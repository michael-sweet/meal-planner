<x-meal_layout :meal="$meal">
    <div class="row">
        <div class="col-12 col-lg-6">
            <form method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="submitted" value="edit_meal" />
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" value="{{ $meal->name }}" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" id="image" class="form-control" />
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
        <div class="col-12 col-lg-6">
            @isset($meal->image_path)
                <img src="{{ asset('storage/' . $meal->image_path) }}" class="img-fluid mt-3" />
            @endisset
        </div>
    </div>
</x-meal_layout>
