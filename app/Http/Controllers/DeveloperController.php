<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DeveloperService;
use App\Traits\ResponseTrait;
use App\Http\Requests\DeveloperRequest;
use App\Models\Developer;  // Make sure this is included
use Illuminate\Support\Facades\Storage;

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
        $developer = Developer::findOrFail($id);
        if (!$developer) {
            return response()->json(['message' => 'Developer not found'], 404);
        }
        $updateData = $request->only([
            'status',
            'first_name',
            'last_name',
            'email',
            'position',
            'description'
        ]);

        if ($request->has('profile_photo')) {
            $photo = $request->input('profile_photo');
            $photoPath = $this->saveBase64Image($photo);
            $updateData['profile_photo'] = $photoPath;
        }

        $developer->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'Developer updated successfully.',
            'data' => $developer
        ]);
    }

    protected function saveBase64Image($base64Image)
    {
        $image = str_replace('data:image/png;base64,', '', $base64Image);
        $image = str_replace(' ', '+', $image);
        $imageName = uniqid() . '.png';
        $imagePath = 'profile-photos/' . $imageName;

        Storage::disk('public')->put($imagePath, base64_decode($image));

        return 'storage/' . $imagePath;
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
