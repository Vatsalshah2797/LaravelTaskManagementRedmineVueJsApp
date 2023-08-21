<?php

/**
 * Trait
 * PHP version 8.2
 *
 * @category App\Http\Helpers
 * @package  Common Helpers
 * @author   Vatsal Shah
 * @license  Vatsal Shah
 * @link     Redmine
 */

namespace App\Http\Helpers;

use App\Models\Task;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

/**
 * Trait CommonTrait
 *
 * @category App\Http\Helpers
 * @package  Common Helpers
 * @author   Vatsal Shah
 * @license  Vatsal Shah
 * @link     Redmine
 */
trait CommonTrait
{
    /**
     * purpose get Issues(Task) details from redmine using guzzle(3rd party in built) http request
     * @param
     * @author Vatsal Shah
     * @return object $tasks
     */
    public function fetchTasksFromRedmineUsingGuzzle()
    {
        $redmineApiUrl = env('REDMINE_API_URL'); // Replace with your Redmine API URL
        $apiKey = env('REDMINE_API_ACCESS_KEY'); // Replace with your Redmine API key

        $client = new Client();

        try {
            $response = $client->get("$redmineApiUrl/issues.json", [
                'headers' => [
                    'X-Redmine-API-Key' => $apiKey,
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            // Process the data and create Task objects
            $tasks = [];
            foreach ($data['issues'] as $issue) {
                $task = new Task([
                    'title' => $issue['subject'],
                    'description' => $issue['description'],
                    // Map other relevant fields
                ]);
                $tasks[] = $task;
            }

            return $tasks;
        } catch (\Exception $e) {
            // Handle errors
            //echo $e->getMessage();
            return [];
        }
    }

    /**
     * purpose create Issues(Task) details in redmine using guzzle http request
     * @param
     * @author Vatsal Shah
     * @return object $tasks
     */
    public function createIssue(Request $request)
    {
        $redmineApiUrl = env('REDMINE_API_URL'); // Replace with your Redmine API URL
        $apiKey = env('REDMINE_API_ACCESS_KEY'); // Replace with your Redmine API key

        $data = [
            'issue' => [
                'project_id' => $request->input('project_id'),
                'subject' => $request->input('subject'),
                'description' => $request->input('description'),
                // Additional fields as needed
            ],
        ];

        $response = Http::withHeaders([
            'X-Redmine-API-Key' => $apiKey,
            'Content-Type' => 'application/json',
        ])->post($redmineApiUrl, $data);

        if ($response->successful()) {
            // Issue created successfully
            return response()->json(['message' => 'Issue created successfully']);
        } else {
            // Issue creation failed
            return response()->json(['error' => 'Issue creation failed'], $response->status());
        }
    }

    /**
     * purpose delete Issues(Task) details in redmine using guzzle http request
     * @param
     * @author Vatsal Shah
     * @return object $tasks
     */
    public function deleteIssue(Request $request, $issueId)
    {
        $redmineApiUrl = env('REDMINE_API_URL'); // Replace with your Redmine API URL
        $apiKey = env('REDMINE_API_ACCESS_KEY'); // Replace with your Redmine API key

        $response = Http::withHeaders([
            'X-Redmine-API-Key' => $apiKey,
        ])->delete($redmineApiUrl);

        if ($response->successful()) {
            // Issue deleted successfully
            return response()->json(['message' => 'Issue deleted successfully']);
        } else {
            // Issue deletion failed
            return response()->json(['error' => 'Issue deletion failed'], $response->status());
        }
    }


    /**
     * purpose get Issues(Task) details from redmine using http request header
     * @param
     * @author Vatsal Shah
     * @return object $tasks
     */
    public function fetchTasksFromRedmineUsingHTTP()
    {
        $redmineApiUrl = env('REDMINE_API_URL'); // Replace with your Redmine API URL
        $apiKey = env('REDMINE_API_ACCESS_KEY'); // Replace with your Redmine API key

        try {
            $response = Http::withHeaders([
                'X-Redmine-API-Key' => $apiKey,
            ])->get("$redmineApiUrl/issues.json");

            $data = $response->json();

            // Process the data and create Task objects
            $tasks = [];
            foreach ($data['issues'] as $issue) {
                $task = new Task([
                    'title' => $issue['subject'],
                    'description' => $issue['description'],
                    // Map other relevant fields
                ]);
                $tasks[] = $task;
            }

            return $tasks;
        } catch (\Exception $e) {
            // Handle errors
            return [];
        }
    }
}