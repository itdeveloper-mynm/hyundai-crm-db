<?php

namespace Database\Factories;
use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    protected $model = Application::class;

    public function definition()
    {

        $types = [
            'leads',
            'request_a_quote',
            'Online Service Booking',
            'special_offers',
            'service_offers',
            'fleet_sales',
            'request_a_test_drive',
            'used_cars',
            'old_leads',
            'after_sales',
        ];


        return [
            'customer_id' => 19, // Replace with actual customer_id
            'city_id' => 16, // Replace with actual city_id
            'branch_id' => 2, // Replace with actual branch_id
            'vehicle_id' => 3, // Replace with actual vehicle_id
            'source_id' => 5, // Replace with actual source_id
            'campaign_id' => 5, // Replace with actual campaign_id
            'type' =>  $types[array_rand($types)],
            'created_at' => Carbon::now(),
            'apply_for' => $this->faker->word,
            'booking_reason' => $this->faker->word,
            'booking_category' => $this->faker->word,
            'department' => $this->faker->word,
            'title' => $this->faker->word,
            'second_surname' => $this->faker->lastName,
            'nationalid' => $this->faker->uuid,
            'zip_code' => $this->faker->postcode,
            'vin' => $this->faker->bothify('**************'),
            'yearr' => $this->faker->year,
            'plateno' => $this->faker->bothify('??###??'),
            'plate_alphabets' => $this->faker->randomLetter,
            'klmm' => $this->faker->word,
            'intention' => $this->faker->word,
            'monthly_salary' => $this->faker->randomFloat(2, 1000, 10000),
            'request_date' => $this->faker->date,
            'preferred_time' => $this->faker->time,
            'comments' => $this->faker->sentence,
            'sharingcv' => $this->faker->boolean,
            'privacy_check' => $this->faker->boolean,
            'marketingagreement' => $this->faker->boolean,
            'language' => $this->faker->languageCode,
            'company' => $this->faker->company,
            'customers_type' => $this->faker->word,
            'number_of_vehicles' => $this->faker->numberBetween(1, 5),
            'fleet_range' => $this->faker->word,
        ];
    }
}
