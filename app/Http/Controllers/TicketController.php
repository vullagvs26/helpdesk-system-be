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
    
}
