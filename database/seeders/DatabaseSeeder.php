<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Response;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // First create 10 users
    $users = User::factory(10)->create();
    
    // Create 10 tickets and associate each with a random user from our collection
    $tickets = Ticket::factory(10)
        ->recycle($users)
        ->create();
    
    // Create 10 responses, each associated with a random ticket and user
    Response::factory(10)
        ->recycle($users)
        ->recycle($tickets)
        ->create();
}
}
