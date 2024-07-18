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
                'full_name' => $ticket->full_name,
                'email' => $ticket->email,
                'ticket_no' => $ticket->ticket_no,
                'type_of_ticket' => $ticket->type_of_ticket,
                'impact' => $ticket->impact,
                'status' => $ticket->status,
                'description' => $ticket->description,
                'remarks' => $ticket->remarks,
                'started_at' => $ticket->started_at,
                'completed_at' => $ticket->completed_at,
                'completed_time' => $ticket->completed_time,
                'image' => $ticket->image ? url('storage/' . $ticket->image) : null,
                'system' => [
                    'system_name' => optional($ticket->systems)->system_name,
                ],
                'developer' => [
                    'assigned_to' => optional($ticket->developers)->email,
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

    public function generateTicketNo()
    {
        // Get the latest ticket number
        $latestTicket = $this->ticket_repository->getLatestTicket();
        
        // Extract the numeric part from the latest ticket number
        $latestTicketNo = $latestTicket ? (int) str_replace('TCKT-', '', $latestTicket->ticket_no) : 0;
        $newTicketNo = 'TCKT-' . str_pad($latestTicketNo + 1, 5, '0', STR_PAD_LEFT);

        return $newTicketNo;
    }
}
