<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{


    public function index()
{
    try {
        // Check if any records exist in the clients table
        $clientsCount = Client::count();

        if ($clientsCount > 0) {
            // If records exist, retrieve them from the database
            $clients = Client::all();
        } else {
            // If no records exist, fetch data from the external API and insert into database
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://system.loanspur.com/fineract-provider/api/v1/authentication?username=patrick&password=admin123&associations=all&tenantIdentifier=umoja&pretty=true');

            if ($response->successful()) {
                $userData = $response->json()['base64EncodedAuthenticationKey'];

                $allClients = Http::withHeaders([
                    'Authorization' => 'Basic ' . base64_encode('patrick:admin123'),
                ])->get('https://system.loanspur.com/fineract-provider/api/v1/clients?fields=displayName,mobileNo,accountNo,officeId,officeName&sortOrder=ASC&associations=all&tenantIdentifier=umoja&pretty=true');
                //orderBy=officeId&officeId=2&
                $clientsData = $allClients->json();
                    //dd($clientsData);
                foreach ($clientsData['pageItems'] as $data) {
                    $client = new Client();
                    $client->name = $data['displayName'];
                    $client->accountNo = $data['accountNo'];
                    $client->officeId=$data['officeId'];
                    $client->officeName = $data['officeName'];
                    $client->save();
                }

                // Retrieve the inserted data from the database
                $clients = Client::all();
                //dd($clients);
            } else {
                echo 'Failed to get user data';
            }
        }

        return view('index')->with('clients', $clients);
    } catch (\Exception $e) {
        Log::error($e);
        return $e->getMessage();
    }
}
 
public function clientListing(){
    // Retrieve all users from the database
    $clients = Client::all();

    // Group the users by office id
    $groupedUsers = $clients->groupBy('officeName');

    // Pass the grouped users to the view
    return view('show', compact('groupedUsers'));


}
}
