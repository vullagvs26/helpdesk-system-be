<?php

namespace App\Services;

use App\Repositories\DeveloperRepository;

class DeveloperService
{

    protected $developer_repository;

    public function __construct(DeveloperRepository $developer_repository)
    {
        $this->developer_repository = $developer_repository;
    }

    public function loadDevelopers()
    {
        $developers = $this->developer_repository->loadDevelopers();
    
        $dataStorage = [];
    
        foreach ($developers as $developer) {
            $dataStorage[] = [
                'id' => $developer['id'],
                'first_name' => $developer->first_name,
                'last_name' => $developer->last_name, 
                'email' => $developer->email,  
                'position' => $developer->position,  
                'description' => $developer->description,   
                'status' => $developer->status, 
                'activeTickets' => count($developer->ticket_active) ,
                'ongoingTickets' => count($developer->ticket_ongoing), 
                'closedTickets' => count($developer->ticket_closed) 
                // 'tickets' => [
                //     'id' => optional($developer->tickets)->id,
                //     'status' => optional($developer->tickets)->status,
                                    
            ];
         
        }
    
        return   $dataStorage;
    }

// app/Services/DeveloperService.php

public function storeDeveloper($data)
{
    // Handle profile photo upload
    if (isset($data['profile_photo'])) {
        $data['profile_photo'] = $this->uploadProfilePhoto($data['profile_photo']);
    }

    return $this->developer_repository->storeDeveloper($data);
}

protected function uploadProfilePhoto($photo)
{
    $imagePath = $photo->store('profile-photos', 'public');
    return $imagePath;
}

    public function showDeveloper($id)
    {
        return $this->developer_repository->showDeveloper($id);
    }

    public function updateDeveloper($id, $data)
    {
        return $this->developer_repository->updateDeveloper($id, $data);
    }

    public function deleteDeveloper($id)
    {
        return $this->developer_repository->deleteDeveloper($id);
    }


}