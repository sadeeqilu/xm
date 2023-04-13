<?php

namespace App\Services;

use App\Mail\AuditMail;
use Mail;
use Illuminate\Support\Facades\Http;


class APIService
{
    public function GetHistory($company_symbol, $start_date, $end_date): array
    {
        $response = Http::withHeaders([
            'X-RapidAPI-Key' => env('X_RAPID_API_KEY'),
            'X-RapidAPI-Host' => 'yh-finance.p.rapidapi.com'
        ])->get(env('XM_DATA_BASE_URL').'?symbol='.$company_symbol);
        $res = json_decode($response->getBody(), true);

        $start = strtotime($start_date);
        $end = strtotime($end_date);

        $data = array_filter($res['prices'], function ($item) use ($start,$end) {
            return $item["date"] >= $start && $item['date'] <= $end;
        });

        return $data;
    }

    public function sendEmail($company_symbol, $start_date, $end_date, $email)
    {
        $company_name = $this->getCompanyName($company_symbol);
        
        $mailData = [
            'title' => $company_name,
            'body' => 'From '.$start_date.' to '.$end_date
        ];
         
        Mail::to($email)->send(new AuditMail($mailData));
    }

    public function getCompanyName($company_symbol)
    {
        $response = Http::get("https://pkgstore.datahub.io/core/nasdaq-listings/nasdaq-listed_json/data/a5bc7580d6176d60ac0b2142ca8d7df6/nasdaq-listed_json.json");
        $res = json_decode($response->getBody(), true);

        $data = array_filter($res, function ($item) use ($company_symbol){
            return strtolower($item["Symbol"]) == strtolower($company_symbol);
        });

        return $data[array_key_first($data)]['Company Name'] ?? "Company Name not found";
    }

    public function getChartData($data)
    {
        $open = array();
        $close = array();
        $dates = array();

        foreach ($data as $row)
        {
            array_push($open, $row['open']);
            array_push($dates, date( "d-m-Y" , $row['date'] ));
            array_push($close, $row['close']);
        }

        return ["open" => $open, "close" => $close, "date" => $dates];
    }
}