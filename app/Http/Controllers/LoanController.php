<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LoanController extends Controller
{
    public function index(){
        try{

            $loansCount= Loan::count();
            if($loansCount>0){
                $loans= Loan::all();
            }else{
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://system.loanspur.com/fineract-provider/api/v1/authentication?username=patrick&password=admin123&associations=all&tenantIdentifier=umoja&pretty=true');

            if ($response->successful()) {
                $userData = $response->json()['base64EncodedAuthenticationKey'];
                $allLoans = Http::withHeaders([
                    'Authorization' => 'Basic ' . base64_encode('patrick:admin123'),
                ])->get('https://system.loanspur.com/fineract-provider/api/v1/loans?limit=0&associations=all&tenantIdentifier=umoja&pretty=true');

                $clientLoans=$allLoans->json();
                //dd($clientLoans);
                foreach($clientLoans['pageItems'] as $data){
                    //dd($data);
                    $loan = new Loan();
                    $loan->accountNo= $data['accountNo'];
                    $loan->clientName =$data['clientName'];
                    $loan->loanProductName= $data['loanProductName'];
                    $loan->principal=$data['principal'];
                    $loan->repayments=$data['numberOfRepayments'];

                   // .^sgOigh&&Ui

                    //foreach($data['summary'] as $summaryData){
                        //var_dump($summaryData);
                        // $amtDisbursed=$summaryData['principalDisbursed'] ;

                       // $summaryData = json_decode($jsonResponse, true)['summary'];


                        // $amtDisbursed = $summaryData['principalDisbursed'];
                        // $loan->amtDisbursed = $amtDisbursed;

                    //}
                    $loan->save();
                }
             $loans = Loan::all();
            }else{
                echo "Failed to get Loans Data";
            }
        }
           return view('loans.loan')->with('loans',$loans);
        }catch(\Exception $e){
            Log::error($e);
            return $e->getMessage();
        }
    }
}
