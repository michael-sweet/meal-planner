<x-layout_unauthed>
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-12 col-lg-6 text-center text-lg-end px-lg-5">
            <div class="mt-5 d-inline-block text-center">
                <div class="bg-white rounded shadow px-4 px-sm-5 py-3 py-sm-4">
                    <h1>Meal Planner</h1>
                    <p class="lead mb-4">(demo system)</p>

                    <form method="post" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-primary icon-link"><i class="fa-solid fa-right-to-bracket"></i>Log in as guest</button>
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
                <div class="my-4">
                    @if (App::environment('demo'))
                        <x-demo_footer></x-demo_footer>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 text-black py-lg-3 mt-5 mt-lg-0">
            <header>
                <h1>Discover Meal Planner: A Practical Approach to Meal Planning</h1>
                <p>A Simple, Efficient Web App Built for Everyday Use</p>
            </header>

            <section>
                <h2>Intuitive Meal Selection</h2>
                <ul>
                    <li><strong>Easy-to-Use Interface:</strong> Experience the simplicity of selecting meals for the week.</li>
                    <li><strong>Customisable Ingredients:</strong> Explore how users can personalise their meal plans by adjusting ingredients.</li>
                </ul>
            </section>

            <section>
                <h2>Streamlined Data Management</h2>
                <ul>
                    <li><strong>Automatic Ingredient Compilation:</strong> Observe how the app compiles ingredients from selected meals.</li>
                    <li><strong>Efficient Shopping List Creation:</strong> Discover how the app effortlessly generates a shopping list tailored to your meal plan.</li>
                </ul>
            </section>

            <section>
                <h2>Focused on User Experience</h2>
                <ul>
                    <li><strong>Reliable Performance:</strong> The app is built with reliable technologies for a smooth experience.</li>
                    <li><strong>Clean Design:</strong> The straightforward design makes it easy to navigate and use the app.</li>
                </ul>
            </section>

            <section>
                <h2>Interactive Demo with Sample Data Option</h2>
                <p>Engage with our interactive demo that includes an option to use sample data. This feature allows you to quickly understand the app's functionality without the need to input your own data. Perfect for a fast and effective demo experience.</p>
            </section>
        </div>
    </div>
</x-layout_unauthed>
