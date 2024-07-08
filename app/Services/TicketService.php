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
                'id' => $ticket->users->id,
                'full_name' => $ticket->users->full_name,
                'email' => $ticket->users->email,
                'position' => $ticket->users->position,
            ],
            'system' => [
                'id' => $ticket->systems->id,
                'system_name' => $ticket->systems->system_name, 
                'published_at' => $ticket->systems->published_at, 
                'developed_by' => $ticket->systems->developed_by,
                'description' => $ticket->systems->description,
            ],
            'developer' => [
                'id' => $ticket->developes->id,
                'first_name' => $ticket->developers->first_name,
                'last_name' => $ticket->developers->last_name,
                'email' => $ticket->developers->email,
                'position' => $ticket->developers->position,
                'description' => $ticket->developers->description,
            ],
           
        ];
        $dataStorage[] = $ticketData;
    }

    return $dataStorage;
}



}