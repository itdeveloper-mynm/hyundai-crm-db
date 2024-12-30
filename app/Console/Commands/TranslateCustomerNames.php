<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Customer;
use GuzzleHttp\Client;

class TranslateCustomerNames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translate:customer-names';
    protected $description = 'Translate customer first names containing specific characters to Arabic using OpenAI API';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch 10 customers based on the provided query
        $customers = Customer::whereRaw("
            first_name LIKE '%Ø§%' OR
            first_name LIKE '%Ø¨%' OR
            first_name LIKE '%Ø­%' OR
            first_name LIKE '%Ù‡%' OR
            last_name LIKE '%Ø§%' OR
            last_name LIKE '%Ø¨%' OR
            last_name LIKE '%Ø­%' OR
            last_name LIKE '%Ù‡%'
        ")->orderby('id','DESC')->take(10)->get();

        if ($customers->isEmpty()) {
            $this->info('No customers found for translation.');
            return;
        }

        $apiKey = env('OPENAI_API_KEY');
        $client = new Client();

        foreach ($customers as $customer) {
            $prompt = "Translate fname {$customer->first_name} and lname {$customer->last_name} to Arabic and keep the keys the same.";

            try {
                $response = $client->post('https://api.openai.com/v1/chat/completions', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $apiKey,
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        'model' => 'gpt-4',
                        'messages' => [
                            ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                            ['role' => 'user', 'content' => $prompt],
                        ],
                    ],
                ]);

                $responseData = json_decode($response->getBody(), true);
                $translatedText = $responseData['choices'][0]['message']['content'] ?? '';

                // Extract translated first_name and last_name using regex
                $fname = null;
                $lname = null;
                if (preg_match('/fname: (.+?) and lname: (.+)/', $translatedText, $matches)) {
                    $fname = trim($matches[1]);
                    $lname = trim($matches[2]);
                }

                // Update the customer's translated names
                $customer->first_name = $fname;
                $customer->last_name = $lname;
                $customer->save();

                $this->info("Translated: {$customer->first_name} {$customer->last_name} to {$fname} {$lname}");
            } catch (\Exception $e) {
                $this->error("Failed to translate {$customer->first_name} {$customer->last_name}: " . $e->getMessage());
            }
        }

        $this->info('Translation process completed.');
    }
}
