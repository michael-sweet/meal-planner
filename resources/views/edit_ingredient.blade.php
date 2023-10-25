<x-layout>
    <div class="row">
        <div class="col-md-4">
            <form method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $ingredient->name }}" />
                </div>
                <div class="mb-3">
                    <label for="unit" class="form-label">Unit (g, ml, kg, etc) </label>
                    <input type="text" name="unit" class="form-control" value="{{ $ingredient->unit }}" />
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</x-layout>
