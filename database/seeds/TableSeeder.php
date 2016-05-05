<?php

use App\Invitation;
use App\Project_User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;
use App\Ticket;
use App\Project;
use App\Customer;
use App\Ticket_User;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //20 users
        $user_types = [00, 01, 10];
        $faker = Faker::create();
        foreach (range(1, 20) as $seededItem) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('123456789'),
                'type' => $faker->randomElement($user_types)
            ]);
        }

        //20 customers
        foreach (range(1,20) as $seededItem) {
            Customer::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'twitter_handle' => '@' . $faker->firstName,
                'phone_number' => $faker->phoneNumber
            ]);
        }

        $users = User::all()->pluck('id')->toArray();

        //5 projects
        foreach (range(1,5) as $seededItem) {
            Project::create([
                'name' => $faker->colorName,
                'description' => $faker->text,
                'created_by' => $faker->randomElement($users)
            ]);
        }

        $customers = Customer::all()->pluck('id')->toArray();
        $projects = Project::all()->pluck('id')->toArray();

        //30 tickets
        $ticket_status = [0, 1, 2];
        $ticket_urgency = [0, 1];
        foreach (range(1,30) as $seededItem){
            Ticket::create([
                'tweet_id' => '2123', //not sure
                'premium' => $faker->boolean(50),
                'customer_id' => $faker->randomElement($customers),
                'status' => $faker->randomElement($ticket_status),
                'opened_by' => $faker->randomElement($users),
                'assigned_to' => $faker->randomElement($users),
                'urgency' => $faker->randomElement($ticket_urgency)
            ]);
        }

        $tickets = Ticket::all()->pluck('id')->toArray();

        //10 unassigned tickets
        foreach (range(1,10) as $seededItem){
            Ticket::create([
                'tweet_id' => '2123', //not sure
                'premium' => $faker->boolean(50),
                'customer_id' => $faker->randomElement($customers),
                'status' => $faker->randomElement($ticket_status),
                'opened_by' => $faker->randomElement($users),
                'assigned_to' => null,
                'urgency' => $faker->randomElement($ticket_urgency),
                'title' => $faker->name,
                'description' => $faker->text
            ]);
        }

        //invited users to random 15 tickets
        foreach (range(1, 15) as $seededItem) {
            Ticket_User::create([
                'user_id' => $faker->randomElement($users),
                'ticket_id' => $faker->randomElement($tickets)
            ]);
        }

        //users invited to projects
        foreach (range(1,20) as $seededItem) {
            Project_User::create([
               'user_id' => $faker->randomElement($users),
                'project_id' => $faker->randomElement($projects)
            ]);
        }

        foreach (range(1, 10) as $seededItem) {
            Invitation::create([
                'status' => $faker->randomElement($ticket_status),
                'created_by' => $faker->randomElement($users),
                'user_invited' => $faker->randomElement($users),
                'ticket_id' => $faker->randomElement($tickets)
            ]);
        }
    }
}
