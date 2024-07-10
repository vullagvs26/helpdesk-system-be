<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TicketService;
use App\Traits\ResponseTrait;
use App\Http\Requests\TicketRequest;

class TicketController extends Controller
{
    use ResponseTrait;
    public $ticket_service;

    public function __construct(TicketService $ticket_service){
        $this->ticket_service = $ticket_service;
    }

    // Display a listing of the resource.
    public function index()
    {
        $result = $this->successResponse('Load Success'); 
        try {
            $result['data'] = $this->ticket_service->loadTickets();
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }    

        return $result; 
    }

    // Store a newly created resource in storage.
    public function store(TicketRequest $ticket_request)
    {
        $result = $this->successResponse('Store Success'); 
        try {
            // Retrieve the validated data from the request
            $validatedData = $ticket_request->validated();
            
            // Generate a new ticket number
            $validatedData['ticket_no'] = $this->ticket_service->generateTicketNo();

            // Handle the image upload
            if ($ticket_request->hasFile('image')) {
                $imagePath = $ticket_request->file('image')->store('images', 'public');
                $validatedData['image'] = $imagePath;
            }

            // Prepare the data to be passed to the service
            $data = [
                'full_name' => $validatedData['full_name'],
                'email' => $validatedData['email'],
                'ticket_no' => $validatedData['ticket_no'],
                'type_of_ticket' => $validatedData['type_of_ticket'],
                'impact' => $validatedData['impact'],
                'status' => $validatedData['status'], 
                'description' => $validatedData['description'], 
                'image' => $validatedData['image'] ?? null,  // Check for image existence
                'system_name_id' => $validatedData['system_name_id'],
                'assigned_to_id' => $validatedData['assigned_to_id'],
            ];

            // Call the storeTicket method in TicketService with the prepared data
            $this->ticket_service->storeTicket($data); 
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $result;
    }

    // Display the specified resource.
    public function show(string $id)
    {
        $result = $this->successResponse("Show Success");

        try {
            $result['data'] = $this->ticket_service->showTicket($id);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $result;
    }

    // Update the specified resource in storage.
    public function update(TicketRequest $ticket_request, string $id)
    {
        $result = $this->successResponse("Update Success");
        try {
            // Retrieve the validated data from the request
            $validatedData = $ticket_request->validated();

            // Handle the image upload
            if ($ticket_request->hasFile('image')) {
                $imagePath = $ticket_request->file('image')->store('images', 'public');
                $validatedData['image'] = $imagePath;
            }

            // Prepare the data to be passed to the service
            $data = [
                'full_name' => $validatedData['full_name'],
                'email' => $validatedData['email'],
                'ticket_no' => $validatedData['ticket_no'],
                'type_of_ticket' => $validatedData['type_of_ticket'],
                'impact' => $validatedData['impact'],
                'status' => $validatedData['status'], 
                'description' => $validatedData['description'], 
                'image' => $validatedData['image'] ?? null,  // Check for image existence
                'system_name_id' => $validatedData['system_name_id'],
                'assigned_to_id' => $validatedData['assigned_to_id'],
            ];

            // Call the updateTicket method in TicketService with the prepared data
            $this->ticket_service->updateTicket($id, $data);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $result;
    }
    
    // Remove the specified resource from storage.
    public function destroy(string $id)
    {
        $result = $this->successResponse("Deleted");

        try {
            $this->ticket_service->deleteTicket($id);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $result;
    }
}
