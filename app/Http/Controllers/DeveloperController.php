<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DeveloperService;
use App\Traits\ResponseTrait;
use App\Http\Requests\DeveloperRequest;
use App\Models\Developer;  // Make sure this is included

class DeveloperController extends Controller
{
    use ResponseTrait;
    public $developer_service;

    public function __construct(DeveloperService $developer_service)
    {
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
        $result = $this->successResponse('Store Success');
        try {
            $data = $developer_request->all();
            if ($developer_request->hasFile('profile_photo')) {
                $data['profile_photo'] = $developer_request->file('profile_photo');
            }
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
            $result['data'] = $this->developer_service->showDeveloper($id);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $result;
    }

    public function update(Request $request, $id)
    {
        // Find the developer
        $developer = Developer::findOrFail($id);

        // Handle file upload if present
        if ($request->hasFile('profile_photo')) {
            // Store the file and get the file path
            $file = $request->file('profile_photo');
            $filePath = $file->store('profile_photos', 'public'); // Store file in 'public/profile_photos'

            // Add the file path to the update data
            $updateData['profile_photo'] = $filePath;
        }

        // Update only the fields that are present in the request
        $updateData = $request->only([
            'status',
            'first_name',
            'last_name',
            'email',
            'position',
            'description'
        ]);

        // Merge the file path if a new file was uploaded
        if (isset($filePath)) {
            $updateData['profile_photo'] = $filePath;
        }

        $developer->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'Developer updated successfully.',
            'data' => $developer
        ]);
    }


    //Remove the specified resource from storage.
    public function destroy(string $id)
    {
        $result = $this->successResponse("Deleted");

        try {
            $this->developer_service->deleteDeveloper($id);
        } catch (\Exception $e) {
            $result = $this->errorresponse($e);
        }
        return $result;
    }
}
