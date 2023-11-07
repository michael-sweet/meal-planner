<?php

namespace App\Console\Commands;

use App\Models\Meal;
use App\Models\User;
use App\Models\MealSelection;
use App\Models\MealIngredient;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class DeleteOldGuests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:delete-old-guests';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (!App::environment('demo')) {
            $this->error('Environment must be demo!');
            return;
        }

        $old_users = User::where('created_at', '<', now()->subDay())->get();
        foreach ($old_users as $user) {
            Storage::deleteDirectory('public/meal_images/' . $user->id);
        }
        $user_ids = $old_users->pluck('id');
        $meal_ids = Meal::whereIn('user_id', $user_ids)->pluck('id');
        MealIngredient::whereIn('meal_id', $meal_ids)->delete();
        MealSelection::whereIn('meal_id', $user_ids)->delete();
        Meal::whereIn('user_id', $user_ids)->forceDelete();
        User::where('created_at', '<', now()->subDay())->forceDelete();

        $this->info('Old guests deleted successfully.');
    }
}
