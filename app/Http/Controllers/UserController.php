<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Traits\ResponseTrait;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    use ResponseTrait;

    public $user_service;

    public function __construct(UserService $user_service){
        $this->user_service = $user_service;
    }

    //Display a listing of the resource.
    public function index()
    {
        $result = $this->successResponse('Load Success'); 
        try {
            $result['data'] = $this->user_service->loadUsers();
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }    

        return $result; 
    }

    //Store a newly created resource in storage.
    public function store(UserRequest $user_request)
    {
        $result = $this->successResponse('Store Success') ; 
        try {
            $data = [
                
                'full_name' => $user_request['full_name'],
                'email' => $user_request['email'],
                'position' => $user_request['position'],
            ];
            $this->user_service->storeUser($data); 
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
             $result ['data']= $this->user_service->showUser($id);
         } catch (\Exception $e) {
             $result = $this->errorResponse($e) ;
         }
         return $result ;
     }

     //Update the specified resource in storage.
    public function update(UserRequest $user_request, string $id)
    {
        $result = $this->successResponse("Update Success");
        try {
            $data = [
                
                'full_name' => $user_request['full_name'],
                'email' => $user_request['email'],
                'position' => $user_request['position'],                                             
            ]; 
            $this->user_service->updateUser($id,$data);
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
            $this->user_service->deleteUser($id);
        } catch (\Exception $e) {
            $result = $this->errorresponse();
        }
        return $result;
    }

}
