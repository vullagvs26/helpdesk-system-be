<?php

namespace App\Services;

use App\Repositories\SystemRepository;

class SystemService
{

    protected $system_repository;

    public function __construct(SystemRepository $system_repository)
    {
        $this->system_repository = $system_repository;
    }

    public function loadSystems()
    {
        $systems = $this->system_repository->loadSystems();
    
        $dataStorage = [];
    
        foreach ($systems as $system) {
            $dataStorage[] = [
                'id' => $system->id,
                'code_name' => $system->code_name,
                'system_name' => $system->system_name,
                'owner' => $system->owner,
                'release' => $system->release,
                'type' => $system->type,
                'deployment' => $system->deployment,
                'language' => $system->language,
                'framework' => $system->framework,
                'database' => $system->database,
                'support_section' => $system->support_section,
                'support_developer' => $system->support_developer,
                'published_at' => $system->published_at,
                'developed_by' => $system->developed_by,
                'description' => $system->description,
                'status' => $system->status,
                'support_primary' => $system->support_primary,
                'support_secondary' => $system->support_secondary,
                'support_tertiary' => $system->support_tertiary,
                'originay_date' => $system->originay_date,
                'portal_date' => $system->portal_date,
                'prod_path' => $system->prod_path,
                'prod_webserver' => $system->prod_webserver,
                'prod_database' => $system->prod_database,
                'dev_url' => $system->dev_url,
                'dev_web' => $system->dev_web,
                'dev_database' => $system->dev_database,
                'back_up_url' => $system->back_up_url,
                'back_up_web' => $system->back_up_web,
                'back_up_database' => $system->back_up_database,
                'git_name' => $system->git_name,
                'git_server' => $system->git_server,
                'ssi_status' => $system->ssi_status,
                'ssi_remarks' => $system->ssi_remarks,
                'ongoing_activity' => $system->ongoing_activity,                      
            ];
         
        }
    
        return $dataStorage;
    }

    public function storeSystem($data)
    {
        return $this->system_repository->storeSystem($data);
    }

    public function showSystem($id)
    {
        return $this->system_repository->showSystem($id);
    }

    public function updateSystem($id, $data)
    {
        return $this->system_repository->updateSystem($id, $data);
    }

    public function deleteSystem($id)
    {
        return $this->system_repository->deleteSystem($id);
    }


}