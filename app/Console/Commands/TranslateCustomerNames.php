<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Customer;
use GuzzleHttp\Client;
use Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

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
        $customers = Customer::whereRaw("
            first_name LIKE '%Ø§%' OR
            first_name LIKE '%Ø¨%' OR
            first_name LIKE '%Ø­%' OR
            first_name LIKE '%Ù‡%' OR
            last_name LIKE '%Ø§%' OR
            last_name LIKE '%Ø¨%' OR
            last_name LIKE '%Ø­%' OR
            last_name LIKE '%Ù‡%'
        ")->take(10)->orderby('id','ASC')->get();

        if ($customers->isEmpty()) {
            $this->info('No customers found for translation.');
            return;
        }

        $apiKey = env('OPENAI_API_KEY');

        foreach ($customers as $customer) {
            Log::info("customer" , [$customer->id]);
            try {

                $search = "Translate fname {$customer->first_name} and lname {$customer->last_name} to Arabic and keep the keys the same.";
                $header=[
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '.$apiKey,

                ];

            $postdata =[
                'model' => 'gpt-4o',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                    ["role" => "user", "content" => $search]
                ],
                'temperature' => 0.5,
                "max_tokens" => 200,

            ];
                $response = Http::withHeaders($header)->post("https://api.openai.com/v1/chat/completions", $postdata)->json();

                $responseData = $response['choices'][0]['message']['content'] ?? '';
                Log::info("api responseData", [$responseData]);
                $fname = null;
                $lname = null;
                // Use regex to extract the JSON part of the content.
                if (preg_match('/\{.*?\}/s', $responseData, $matches)) {
                    $jsonContent = $matches[0]; // Extracted JSON string

                    // Attempt to parse the JSON.
                    $parsedContent = json_decode($jsonContent, true);

                    if (json_last_error() === JSON_ERROR_NONE) {
                        // Successfully parsed JSON.
                        $fname = $parsedContent['fname'] ?? null;
                        $lname = $parsedContent['lname'] ?? null;
                        Log::info('parsedContent', [$parsedContent, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE]);
                        // echo json_encode($parsedContent, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                    } else {
                        // JSON parsing failed.
                        Log::info("Failed to parse extracted JSON:" , [$jsonContent]);
                        // echo "Failed to parse extracted JSON: {$jsonContent}";
                    }
                } else {
                    // No JSON found in the content.
                        Log::info("No valid JSON content found:" , [$responseData]);
                        // echo "No valid JSON content found: {$responseData}";
                }

                Log::info("Translated: {$customer->first_name} {$customer->last_name} to {$fname} {$lname}");

                // Update the customer's translated names
                if (!is_null($fname) && $fname !== '') {
                    $customer->first_name = $fname;
                    $customer->last_name = $lname;
                    $customer->save();
                }

                $this->info("Translated: {$customer->first_name} {$customer->last_name} to {$fname} {$lname}");
            } catch (\Exception $e) {
                Log::error("Failed to translate customer ID {$customer->id}: " . $e->getMessage());
            }
        }

        $this->info('Translation process completed.');
    }


    // public function handle()
    // {
    //     $customers = Customer::whereRaw("
    //         first_name LIKE '%Ø§%' OR
    //         first_name LIKE '%Ø¨%' OR
    //         first_name LIKE '%Ø­%' OR
    //         first_name LIKE '%Ù‡%' OR
    //         last_name LIKE '%Ø§%' OR
    //         last_name LIKE '%Ø¨%' OR
    //         last_name LIKE '%Ø­%' OR
    //         last_name LIKE '%Ù‡%'
    //     ")->take(1)->get();

    //     if ($customers->isEmpty()) {
    //         $this->info('No customers found for translation.');
    //         return;
    //     }

    //     $apiKey = env('OPENAI_API_KEY');

    //     foreach ($customers as $customer) {
    //         $prompt = "Translate fname {$customer->first_name} and lname {$customer->last_name} to Arabic and keep the keys the same.";

    //         try {
    //             $maxRetries = 5;
    //             $retryDelay = 2; // seconds
    //             $attempt = 0;

    //             do {
    //                 $ch = curl_init('https://api.openai.com/v1/chat/completions');
    //                 $data = [
    //                     'model' => 'gpt-4o',
    //                     'messages' => [
    //                         ['role' => 'system', 'content' => 'You are a translator that specializes in Arabic translations.'],
    //                         // ['role' => 'system', 'content' => 'You are a helpful assistant.'],
    //                         ['role' => 'user', 'content' => $prompt],
    //                     ],
    //                 ];

    //                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //                 curl_setopt($ch, CURLOPT_POST, true);
    //                 curl_setopt($ch, CURLOPT_HTTPHEADER, [
    //                     'Authorization: Bearer ' . $apiKey,
    //                     'Content-Type: application/json',
    //                 ]);
    //                 curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    //                 $response = curl_exec($ch);
    //                 $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    //                 if ($response !== false && $httpCode === 200) {
    //                     curl_close($ch);
    //                     break; // Exit loop on success
    //                 }

    //                 if ($httpCode === 429) {
    //                     $attempt++;
    //                     \Log::warning("Rate limit hit. Retrying in {$retryDelay} seconds. Attempt {$attempt} of {$maxRetries}.");
    //                     sleep($retryDelay);
    //                 } else {
    //                     \Log::error('cURL error: ' . curl_error($ch) . ' HTTP Code: ' . $httpCode);
    //                     break; // Exit loop on non-retriable error
    //                 }

    //                 curl_close($ch);
    //             } while ($attempt < $maxRetries);

    //             if ($httpCode !== 200) {
    //                 \Log::error("API request failed after {$maxRetries} attempts for customer ID: {$customer->id}");
    //                 continue;
    //             }

    //             $responseData = json_decode($response, true);
    //             $translatedText = $responseData['choices'][0]['message']['content'] ?? '';

    //             // Extract translated first_name and last_name using regex
    //             $fname = null;
    //             $lname = null;
    //             if (preg_match('/fname: (.+?) and lname: (.+)/', $translatedText, $matches)) {
    //                 $fname = trim($matches[1]);
    //                 $lname = trim($matches[2]);
    //             }

    //             // Update the customer's translated names
    //             $customer->first_name = $fname;
    //             $customer->last_name = $lname;
    //             $customer->save();

    //             $this->info("Translated: {$customer->first_name} {$customer->last_name} to {$fname} {$lname}");
    //         } catch (\Exception $e) {
    //             \Log::error("Failed to translate customer ID {$customer->id}: " . $e->getMessage());
    //         }
    //     }

    //     $this->info('Translation process completed.');
    // }

    // public function handle()
    // {
    //      // Fetch 10 customers based on the provided query
    //      $customers = Customer::whereRaw("
    //          first_name LIKE '%Ø§%' OR
    //          first_name LIKE '%Ø¨%' OR
    //          first_name LIKE '%Ø­%' OR
    //          first_name LIKE '%Ù‡%' OR
    //          last_name LIKE '%Ø§%' OR
    //          last_name LIKE '%Ø¨%' OR
    //          last_name LIKE '%Ø­%' OR
    //          last_name LIKE '%Ù‡%'
    //      ")->orderby('id','ASC')->take(1)->get();

    //      if ($customers->isEmpty()) {
    //          $this->info('No customers found for translation.');
    //          return;
    //      }

    //      $apiKey = env('OPENAI_API_KEY');

    //      foreach ($customers as $customer) {
    //          $prompt = "Translate fname {$customer->first_name} and lname {$customer->last_name} to Arabic and keep the keys the same.";

    //          try {
    //              // Prepare cURL request
    //              $ch = curl_init('https://api.openai.com/v1/chat/completions');

    //              $data = [
    //                  'model' => 'gpt-4',
    //                  'messages' => [
    //                      ['role' => 'system', 'content' => 'You are a helpful assistant.'],
    //                      ['role' => 'user', 'content' => $prompt],
    //                  ],
    //              ];

    //              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //              curl_setopt($ch, CURLOPT_POST, true);
    //              curl_setopt($ch, CURLOPT_HTTPHEADER, [
    //                  'Authorization: Bearer ' . $apiKey,
    //                  'Content-Type: application/json',
    //              ]);
    //              curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    //              $response = curl_exec($ch);
    //              $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    //              if ($response === false || $httpCode !== 200) {
    //                  throw new \Exception('cURL error: ' . curl_error($ch) . ' HTTP Code: ' . $httpCode);
    //              }

    //              curl_close($ch);

    //              $responseData = json_decode($response, true);
    //              $translatedText = $responseData['choices'][0]['message']['content'] ?? '';

    //              // Extract translated first_name and last_name using regex
    //              $fname = null;
    //              $lname = null;
    //              if (preg_match('/fname: (.+?) and lname: (.+)/', $translatedText, $matches)) {
    //                  $fname = trim($matches[1]);
    //                  $lname = trim($matches[2]);
    //              }

    //              // Update the customer's translated names
    //              $customer->first_name = $fname;
    //              $customer->last_name = $lname;
    //              $customer->save();

    //              $this->info("Translated: {$customer->first_name} {$customer->last_name} to {$fname} {$lname}");
    //          } catch (\Exception $e) {
    //              \Log::info($e->getMessage());
    //              $this->error("Failed to translate {$customer->first_name} {$customer->last_name}: " . $e->getMessage());
    //          }
    //      }

    //      $this->info('Translation process completed.');
    // }

    // public function handle()
    // {
    //     // Fetch 10 customers based on the provided query
    //     $customers = Customer::whereRaw("
    //         first_name LIKE '%Ø§%' OR
    //         first_name LIKE '%Ø¨%' OR
    //         first_name LIKE '%Ø­%' OR
    //         first_name LIKE '%Ù‡%' OR
    //         last_name LIKE '%Ø§%' OR
    //         last_name LIKE '%Ø¨%' OR
    //         last_name LIKE '%Ø­%' OR
    //         last_name LIKE '%Ù‡%'
    //     ")->orderby('id','DESC')->take(1)->get();

    //     if ($customers->isEmpty()) {
    //         $this->info('No customers found for translation.');
    //         return;
    //     }

    //     $apiKey = env('OPENAI_API_KEY');
    //     $client = new Client();

    //     foreach ($customers as $customer) {
    //         $prompt = "Translate fname {$customer->first_name} and lname {$customer->last_name} to Arabic and keep the keys the same.";

    //         try {
    //             $response = $client->post('https://api.openai.com/v1/chat/completions', [
    //                 'headers' => [
    //                     'Authorization' => 'Bearer ' . $apiKey,
    //                     'Content-Type' => 'application/json',
    //                 ],
    //                 'json' => [
    //                     'model' => 'gpt-4',
    //                     'messages' => [
    //                         ['role' => 'system', 'content' => 'You are a helpful assistant.'],
    //                         ['role' => 'user', 'content' => $prompt],
    //                     ],
    //                 ],
    //             ]);

    //             $responseData = json_decode($response->getBody(), true);
    //             $translatedText = $responseData['choices'][0]['message']['content'] ?? '';

    //             // Extract translated first_name and last_name using regex
    //             $fname = null;
    //             $lname = null;
    //             if (preg_match('/fname: (.+?) and lname: (.+)/', $translatedText, $matches)) {
    //                 $fname = trim($matches[1]);
    //                 $lname = trim($matches[2]);
    //             }

    //             // Update the customer's translated names
    //             $customer->first_name = $fname;
    //             $customer->last_name = $lname;
    //             $customer->save();

    //             $this->info("Translated: {$customer->first_name} {$customer->last_name} to {$fname} {$lname}");
    //         } catch (\Exception $e) {
    //             Log::info($e->getMessage());
    //             $this->error("Failed to translate {$customer->first_name} {$customer->last_name}: " . $e->getMessage());
    //         }
    //     }

    //     $this->info('Translation process completed.');
    // }
}
