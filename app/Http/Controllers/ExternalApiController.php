<?php
namespace App\Http\Controllers;

use App\Services\ExternalApiService;
use Illuminate\Http\Request;

class ExternalApiController extends Controller{

    protected $externalApiService;

    public function __construct(ExternalApiService $externalApiService)
    {
        $this->externalApiService = $externalApiService;
    }


    public function getUsers()
    {
      return  $users = $this->externalApiService->getUsers();
//dd($users);
        return view('Api.external_users', compact('users'));
    }
}
