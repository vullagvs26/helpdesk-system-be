<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DeveloperService;
use App\Traits\ResponseTrait;
use App\Http\Requests\DeveloperRequest;

class DeveloperController extends Controller
{
    use ResponseTrait;
    public $developer_service;

    public function __construct(DeveloperService $developer_service){
        $this->developer_service = $developer_service;
    }

    //Display a listing of the resource.
    public function index()
    {
        $result = $this->successResponse('Load Success'); 
        // try {
           $result['data'] = $this->developer_service->loadDevelopers();
        // } catch (\Exception $e) {
        //     $result = $this->errorResponse($e);
        // }    

        return $result; 
    }
    //Store a newly created resource in storage.
    public function store(DeveloperRequest $developer_request)
    {
        $result = $this->successResponse('Store Success') ; 
        try {
            $data = [
                
                'first_name' => $developer_request['first_name'],
                'last_name' => $developer_request['last_name'],
                'email' => $developer_request['email'],
                'position' => $developer_request['position'],
                'description' => $developer_request['description'],
                'status' => $developer_request['status'],
         
            ];
            $this->developer_service->storeDeveloper($data); 
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
             $result ['data']= $this->developer_service->showDeveloper($id);
         } catch (\Exception $e) {
             $result = $this->errorResponse($e) ;
         }
         return $result ;
     }
     //Update the specified resource in storage.
    public function update(DeveloperRequest $developer_request, string $id)
    {
        $result = $this->successResponse("Update Success");
        try {
            $data = [
                
                'first_name' => $developer_request['first_name'],
                'last_name' => $developer_request['last_name'],
                'email' => $developer_request['email'],
                'position' => $developer_request['position'],
                'description' => $developer_request['description'],
                'status' => $developer_request['status'],    
                'profile_photo' => $developer_request->hasFile('profile_photo') ? $developer_request->file('profile_photo')->store('profile-photos', 'public') : null,           
            ]; 
            $this->developer_service->updateDeveloper($id,$data);
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
            $this->developer_service->deleteDeveloper($id);
        } catch (\Exception $e) {
            $result = $this->errorresponse();
        }
        return $result;
    }
}
