<x-layout_unauthed>
    <div class="row justify-content-center align-items-center vh-100 text-center">
        <div class="col">
            <div class="bg-white rounded shadow px-5 py-4 d-inline-block">
                <h1>Meal Planner</h1>
                <p class="lead mb-5">(demo system)</p>

                <form method="post" class="m-0">
                    @csrf
                    <input type="hidden" name="submitted" value="log_in" />
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-right-to-bracket"></i>Log in as guest</button>
                    <div>
                        <div class="form-check form-switch form-check-inline mt-4">
                            <input class="form-check-input" type="checkbox" name="sample_data" value="1" id="sample_data" checked>
                            <label class="form-check-label" for="sample_data">
                                Include sample data
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div>
                <a href="https://github.com/michael-sweet/meal-planner" target="_blank" class="btn btn-link mt-3"><i class="fa-brands fa-github"></i>View the code</a>
            </div>
        </div>
    </div>
</x-layout_unauthed>
