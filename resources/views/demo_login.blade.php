<x-layout_unauthed>
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-12 col-md-6 text-center text-md-end px-lg-5">
            <div class="mt-5 d-inline-block text-center">
                <div class="bg-white rounded shadow px-5 py-4">
                    <h1>Meal Planner</h1>
                    <p class="lead mb-4">(demo system)</p>

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
                <div class="mb-4">
                    <a href="https://github.com/michael-sweet/meal-planner" target="_blank" class="btn btn-link mt-3"><i class="fa-brands fa-github"></i>View the code</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 py-md-3">
            <h1>Meal Planner Demo</h1>

            <p>I've developed a handy tool that I think you'll find interesting. If you've ever found meal planning and grocery shopping a tad overwhelming, this might be right up your alley.</p>

            <h2>Features at a Glance:</h2>

            <ul>
                <li><strong>Weekly Meal Selection:</strong> Pick your dishes for the week from a variety of options.</li>
                <li><strong>Automated Grocery List:</strong> Based on your meal choices, the tool compiles a shopping list, ensuring you get just what you need.</li>
                <li><strong>Cooking Instructions:</strong> Each meal you select comes with a list of ingredients and simple cooking steps.</li>
            </ul>

            <h2>Why I Built This:</h2>

            <p>This demo showcases a few things:</p>

            <ul>
                <li>My ability to understand and simplify everyday challenges through technology.</li>
                <li>Creating functional systems that adapt based on user choices.</li>
                <li>Ensuring user experience is straightforward and hassle-free.</li>
            </ul>

            <p>I'm quite proud of how this Meal Planner turned out. It reflects a slice of my approach to software development: practical, user-oriented, and efficient.</p>

            <p><em>Note: This is just one example of what I can do. If you're considering a software solution or just curious about my work, let's chat. I'm always open to new projects and ideas.</em></p>
        </div>
    </div>
</x-layout_unauthed>
