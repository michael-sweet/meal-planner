<x-layout>
    <h1 class="mb-3">
        Ingredients
        <a href="{{ route('ingredients.edit', [0]) }}" class="ms-2"><i class="fa-solid fa-circle-plus"></i></a>
    </h1>
    <table class="table">
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
                                <li><a class="dropdown-item" href="{{ route('ingredients.edit', [$ingredient->id]) }}">Edit</a></li>
                                <li>
                                    <form method="post" action="{{ route('ingredients.delete', [$ingredient->id]) }}" class="m-0">
                                        @csrf
                                        <button class="dropdown-item js-modal-confirm"
                                            data-modal-title="{{ $ingredient->name }}"
                                            data-modal-body="<p><strong>Are you sure you want to delete?</strong></p><p>There are <strong>{{ $ingredient->meals->count() }}</strong> meal(s) with this ingredient.</p>"
                                            data-modal-action="Delete"
                                            data-modal-action-class="btn-danger">
                                            Delete
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
</x-layout>
