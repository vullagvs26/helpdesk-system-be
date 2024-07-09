<?php

namespace App\Repositories;

use App\Models\Ticket;

class TicketRepository {
    public $ticket_model;

    public function __construct(Ticket $ticket_model) {
        $this->ticket_model = $ticket_model; 
    }
    
    public function loadTickets(){
        return $this->ticket_model->with('systems', 'developers')->get();
    } 
    
    public function storeTicket($data) {
        return $this->ticket_model->create($data);
    }
    
    public function showTicket($id) {
        return $this->ticket_model->where("id", $id)->get();
    }
    
    public function updateTicket($id, $data) {
        return $this->ticket_model->where("id", $id)->update($data);
    }
    
    public function deleteTicket($id) {
        return $this->ticket_model->where("id", $id)->delete();
    }
}
