<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Modules\Plan\Entities\Plan;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id'   => rand(1000000, 999999999),
            'transaction_id'   => uniqid('tr_'),
            'payment_provider' => Arr::random(['flutterwave', 'mollie', 'midtrans', 'paypal', 'paystack', 'razorpay', 'sslcommerz', 'stripe', 'instamojo']),
            'plan_id'      => Plan::inRandomOrder()->value('id'),
            'user_id'  => User::inRandomOrder()->value('id'),
            'amount'       => Arr::random([20, 50, 100]),
            'currency_symbol' => Arr::random(['$', '£', '€']),
            'usd_amount'       => Arr::random([20, 50, 100]),
            'payment_status' => 'paid',
            'created_at'  => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
