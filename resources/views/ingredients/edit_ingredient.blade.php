<x-layout>
    @section('container_class', 'container__main--sm')

    <form method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $ingredient->name) }}" />
        </div>
        <div class="mb-3">
            <label for="unit" class="form-label">Unit (g, ml, kg, etc) </label>
            <input type="text" name="unit" class="form-control" value="{{ old('unit', $ingredient->unit) }}" />
        </div>
        <button type="submit" class="btn btn-primary icon-link"><i class="fa-solid fa-floppy-disk"></i>Save</button>
        <a href="{{ route('ingredients') }}" class="btn btn-secondary icon-link"><i class="fa-solid fa-xmark"></i>Cancel</a>
    </form>
</x-layout>
