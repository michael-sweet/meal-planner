<x-layout>
    <a href="{{ route('ingredients.edit', [0]) }}" class="btn btn-primary icon-link mb-3"><i class="fa-solid fa-plus"></i>Add ingredient</a>
    @if ($ingredients->isEmpty())
        <p>No ingredients</p>
    @else
    <div class="table-responsive">
        <table class="table table-striped m-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Unit</th>
                    <th>Meal count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ingredients as $ingredient)
                    <tr>
                        <td>{{ $ingredient->name }}</td>
                        <td>{{ $ingredient->unit }}</td>
                        <td>{{ $ingredient->meals->count() }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-link" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item icon-link" href="{{ route('ingredients.edit', [$ingredient->id]) }}">
                                            <i class="fa-solid fa-pen-to-square"></i>Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form method="post" action="{{ route('ingredients.delete', [$ingredient->id]) }}" class="m-0">
                                            @csrf
                                            <button class="dropdown-item icon-link js-modal-confirm"
                                                data-modal-title="{{ $ingredient->name }}"
                                                data-modal-body="<p><strong>Are you sure you want to delete?</strong></p><p>There are <strong>{{ $ingredient->meals->count() }}</strong> meal(s) with this ingredient.</p>"
                                                data-modal-action="Delete"
                                                data-modal-action-class="btn-danger">
                                                <i class="fa-solid fa-trash"></i>Delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</x-layout>
