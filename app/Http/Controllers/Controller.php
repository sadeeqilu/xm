<?php

namespace App\Http\Controllers;

use App\Http\Requests\XMFormRequest;
use App\Services\APIService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $apiService;

    public function __construct(APIService $apiService) 
    {
        $this->apiService = $apiService;
    }

    public function send(XMFormRequest $request)
    {

        $data = $request->validated();

        $historyData = $this->apiService->GetHistory($data['company_symbol'],$data['start_date'],$data['end_date']);

        // Send Email
        $this->apiService->sendEmail($data['company_symbol'],$data['start_date'],$data['end_date'], $data['email']);

        // $chartData = $this->apiService->getChartData($historyData);

        return view('welcome')->with('prices' , $historyData);
    }
}
