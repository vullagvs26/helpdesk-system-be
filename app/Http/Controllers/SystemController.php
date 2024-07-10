<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SystemService;
use App\Traits\ResponseTrait;
use App\Http\Requests\SystemRequest;

class SystemController extends Controller
{
    use ResponseTrait;
    public $system_service;

    public function __construct(SystemService $system_service){
        $this->system_service = $system_service;
    }

    //Display a listing of the resource.
    public function index()
    {
        $result = $this->successResponse('Load Success'); 
        try {
            $result['data'] = $this->system_service->loadSystems();
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }    

        return $result; 
    }

    //Store a newly created resource in storage.
    public function store(SystemRequest $system_request)
    {
        $result = $this->successResponse('Store Success') ; 
        try {
            $data = [
                
                'system_name' => $system_request['system_name'],
                'published_at' => $system_request['published_at'],
                'developed_by' => $system_request['developed_by'],
                'description' => $system_request['description'],
                'status' => $system_request['status'],  
         
            ];
            $this->system_service->storeSystem($data); 
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $result;
    }
    //Display the specified resource.
    public function show(string $id)
    {
        $result = $this->successResponse("Show Success");

        try {
            $result ['data']= $this->system_service->showSystem($id);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e) ;
        }
        return $result ;
    }

    //Update the specified resource in storage.
    public function update(SystemRequest $system_request, string $id)
    {
        $result = $this->successResponse("Update Success");
        try {
            $data = [
                
                'system_name' => $system_request['system_name'],
                'published_at' => $system_request['published_at'],
                'developed_by' => $system_request['developed_by'],
                'description' => $system_request['description'],
                'status' => $system_request['status'],                
            ]; 
            $this->system_service->updateSystem($id,$data);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e) ;
        }
        return $result ;
    }

    //Remove the specified resource from storage.
    public function destroy(string $id)
    {
        $result = $this->successResponse("Deleted");

        try {
            $this->system_service->deleteSystem($id);
        } catch (\Exception $e) {
            $result = $this->errorresponse();
        }
        return $result;
    }

}
