<?php

namespace App\Services;

use App\Repositories\TicketRepository;

class TicketService
{
    protected $ticket_repository;

    public function __construct(TicketRepository $ticket_repository)
    {
        $this->ticket_repository = $ticket_repository;
    }

    public function loadTickets()
{
    $tickets = $this->ticket_repository->loadTickets();

    $dataStorage = [];

    foreach ($tickets as $ticket) {
        $dataStorage[] = [
            'id' => $ticket->id,
            'ticket_no' => $ticket->ticket_no,
            'type_of_ticket' => $ticket->type_of_ticket,
            'impact' => $ticket->impact,
            'status' => $ticket->status,
            'description' => $ticket->description,
            'image' => $ticket->image, 
            'user' => [
                
                'full_name' => $ticket->users->full_name ?? null,
                'email' => $ticket->users->email ?? null,
                
            ],
            'system' => [
               
                'system_name' => $ticket->systems->system_name ?? null, 
               
            ],
            'developer' => [
                
                'email' => $ticket->developers->email ?? null,
               
            ],
           
        ];
     
    }

    return $dataStorage;
}

    public function storeTicket($data)
    {
        return $this->ticket_repository->storeTicket($data);
    }

    public function showTicket($id)
    {
        return $this->ticket_repository->showTicket($id);
    }

    public function updateTicket($id, $data)
    {
        return $this->ticket_repository->updateTicket($id, $data);
    }

    public function deleteTicket($id)
    {
        return $this->ticket_repository->deleteTicket($id);
    }



}