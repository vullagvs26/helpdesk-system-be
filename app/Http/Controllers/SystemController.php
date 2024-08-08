<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SystemService;
use App\Traits\ResponseTrait;
use App\Http\Requests\SystemRequest;
use App\Exports\SystemsExport;
use Maatwebsite\Excel\Facades\Excel;

class SystemController extends Controller
{
    use ResponseTrait;
    public $system_service;

    public function __construct(SystemService $system_service){
        $this->system_service = $system_service;
    }

    //Display a listing of the resource.
    public function index()
    {
        $result = $this->successResponse('Load Success'); 
        try {
            $result['data'] = $this->system_service->loadSystems();
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }    

        return $result; 
    }

    //Store a newly created resource in storage.
    public function store(SystemRequest $system_request)
    {
        $result = $this->successResponse('Store Success') ; 
        try {
            $data = [
                
                'code_name' => $system_request['code_name'],
                'system_name' => $system_request['system_name'],
                'owner' => $system_request['owner'],
                'release' => $system_request['release'],
                'type' => $system_request['type'],
                'deployment' => $system_request['deployment'],
                'language' => $system_request['language'],
                'framework' => $system_request['framework'],
                'database' => $system_request['database'],
                'support_section' => $system_request['support_section'],
                'support_developer' => $system_request['support_developer'],
                'published_at' => $system_request['published_at'],
                'developed_by' => $system_request['developed_by'],
                'description' => $system_request['description'],
                'status' => $system_request['status'],
                'support_primary' => $system_request['support_primary'],
                'support_secondary' => $system_request['support_secondary'],
                'support_tertiary' => $system_request['support_tertiary'],
                'originay_date' => $system_request['originay_date'],
                'portal_date' => $system_request['portal_date'],
                'prod_path' => $system_request['prod_path'],
                'prod_webserver' => $system_request['prod_webserver'],
                'prod_database' => $system_request['prod_database'],
                'dev_url' => $system_request['dev_url'],
                'dev_web' => $system_request['dev_web'],
                'dev_database' => $system_request['dev_database'],
                'back_up_url' => $system_request['back_up_url'],
                'back_up_web' => $system_request['back_up_web'],
                'back_up_database' => $system_request['back_up_database'],
                'git_name' => $system_request['git_name'],
                'git_server' => $system_request['git_server'],
                'ssi_status' => $system_request['ssi_status'],
                'ssi_remarks' => $system_request['ssi_remarks'],
                'ongoing_activity' => $system_request['ongoing_activity'],
                'developer_id' => $system_request['developer_id'],
         
            ];
            $this->system_service->storeSystem($data); 
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
            $result ['data']= $this->system_service->showSystem($id);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e) ;
        }
        return $result ;
    }

    //Update the specified resource in storage.
    public function update(SystemRequest $system_request, string $id)
    {
        $result = $this->successResponse("Update Success");
        try {
            $data = [
                
                'code_name' => $system_request['code_name'],
                'system_name' => $system_request['system_name'],
                'owner' => $system_request['owner'],
                'release' => $system_request['release'],
                'type' => $system_request['type'],
                'deployment' => $system_request['deployment'],
                'language' => $system_request['language'],
                'framework' => $system_request['framework'],
                'database' => $system_request['database'],
                'support_section' => $system_request['support_section'],
                'support_developer' => $system_request['support_developer'],
                'published_at' => $system_request['published_at'],
                'developed_by' => $system_request['developed_by'],
                'description' => $system_request['description'],
                'status' => $system_request['status'],
                'support_primary' => $system_request['support_primary'],
                'support_secondary' => $system_request['support_secondary'],
                'support_tertiary' => $system_request['support_tertiary'],
                'originay_date' => $system_request['originay_date'],
                'portal_date' => $system_request['portal_date'],
                'prod_path' => $system_request['prod_path'],
                'prod_webserver' => $system_request['prod_webserver'],
                'prod_database' => $system_request['prod_database'],
                'dev_url' => $system_request['dev_url'],
                'dev_web' => $system_request['dev_web'],
                'dev_database' => $system_request['dev_database'],
                'back_up_url' => $system_request['back_up_url'],
                'back_up_web' => $system_request['back_up_web'],
                'back_up_database' => $system_request['back_up_database'],
                'git_name' => $system_request['git_name'],
                'git_server' => $system_request['git_server'],
                'ssi_status' => $system_request['ssi_status'],
                'ssi_remarks' => $system_request['ssi_remarks'],
                'ongoing_activity' => $system_request['ongoing_activity'], 
                'developer_id' => $system_request['developer_id'],          
            ]; 
            $this->system_service->updateSystem($id,$data);
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
            $this->system_service->deleteSystem($id);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e); 
        }
        
        return $result;
    }

    public function export()
    {
        $filename = 'systems.xlsx' ;
        return Excel::download(new SystemsExport, $filename);
    }

}
