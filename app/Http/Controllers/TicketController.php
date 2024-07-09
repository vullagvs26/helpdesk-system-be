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

    //Display a listing of the resource.
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

    //Store a newly created resource in storage.
    public function store(TicketRequest $ticket_request)
    {
        $result = $this->successResponse('Store Success') ; 
        try {
            $data = [
                
                'ticket_no' => $ticket_request['ticket_no'],
                'type_of_ticket' => $ticket_request['type_of_ticket'],
                'impact' => $ticket_request['impact'],
                'status' => $ticket_request['status'], 
                'description' => $ticket_request['description'], 
                'image' => $ticket_request['image'],
            ];
            $this->ticket_service->storeTicket($data); 
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
            $result ['data']= $this->ticket_service->showTicket($id);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e) ;
        }
        return $result ;
    }

    //Update the specified resource in storage.
    public function update(TicketRequest $ticket_request, string $id)
    {
        $result = $this->successResponse("Update Success");
        try {
            $data = [
                
                'ticket_no' => $ticket_request['ticket_no'],
                'type_of_ticket' => $ticket_request['type_of_ticket'],
                'impact' => $ticket_request['impact'],
                'status' => $ticket_request['status'], 
                'description' => $ticket_request['description'], 
                'image' => $ticket_request['image'],
                 
            ]; 
            $this->ticket_service->updateTicket($id,$data);
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
            $this->ticket_service->deleteTicket($id);
        } catch (\Exception $e) {
            $result = $this->errorresponse();
        }
        return $result;
    }
    
}
