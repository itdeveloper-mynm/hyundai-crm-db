<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use App\Imports\CrmLeadsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\CrmLead;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\DB;

class CrmLeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:crm-leads-list', ['only' => ['index','show']]);
        $this->middleware('permission:crm-leads-create', ['only' => ['create','store']]);
        $this->middleware('permission:crm-leads-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:crm-leads-delete', ['only' => ['destroy']]);
        $this->middleware('permission:crm-leads-import', ['only' => ['crmleadsImport']]);
        $this->middleware('permission:crm-leads-export', ['only' => ['crmleadsExport']]);
    }
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $data = getCommonData();

        return view('admin.crn_lead.index' ,$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $data = getCommonData();

        return view('admin.crn_lead.add' , $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        CrmLead::storeData($request);

        return Response(['result'=>'success','message'=>__('Added Successfully')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $lead = CrmLead::findorFail($id);
        $data = getCommonData($lead->city_id);
        $data['lead'] = $lead;

        return view('admin.crn_lead.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        CrmLead::updateData($request,$id);

        return Response(['result'=>'success','message'=>__('Updated Successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $row = CrmLead::findorFail($id);
        $row->delete();

        return Response(['result'=>'success','message'=>__('Deleted Successfully')]);
    }


    public function crmLeadPagination()
    {
        // -- START DEFAULT DATATABLE QUERY PARAMETER
        $draw = request('draw');
        $start = request('start');
        $length = request('length');
        $page = (int)$start > 0 ? ($start / $length) + 1 : 1;
        $limit = (int)$length > 0 ? $length : 10;
        $columnIndex = request('order')[0]['column']; // Column index
        $columnName = request('columns')[$columnIndex]['data']; // Column name
        $columnSortOrder = request('order')[0]['dir']; // asc or desc value
        $searchValue = request('search')['value']; // Search value from datatable
        //-- END DEFAULT DATATABLE QUERY PARAMETER
        $conditions = request()->all();
        //dd($conditions,$conditions['search']['value']);

        //-- WE MUST HAVE COUNT ALL RECORDS WITHOUT ANY FILTERS
        $countAll = CrmLead::count();

        //-- CREATE LARAVEL PAGINATION
        $paginate =  CrmLead::search($conditions)
                ->orderBy($columnName, $columnSortOrder)
                ->paginate($limit, ["*"], 'page', $page);

        $num = 1;
        $items = array();
        foreach ($paginate->items() as $idx => $row) {

            $items[] = array(
                "no" => $num,
                "id" => $row['id'],
                "first_name" => ucwords($row->customer->first_name),
                "last_name" => ucwords($row->customer->last_name),
                "city_id" => $row->city->name ?? "",
                "branch_id" => $row->branch->name ?? "",
                "vehicle_id" => $row->vehicle->name ?? "",
                "source_id" => $row->source->name ?? "",
                "campaign_id" => $row->campaign->name ?? "",
                "created_at" =>$row['created_at'],
            );
            $num++;
        }
        //-- START CREATE JSON RESPONSE FOR DATATABLES
        $response = array(
            "draw" => (int)$draw,
            "recordsTotal" => (int)$countAll,
            "recordsFiltered" => (int)$paginate->total(),
            "data" => $items,
        );
        return response()->json($response);
        //-- END CREATE JSON RESPONSE FOR DATATABLES

   }

   public function crmleadsImport()
   {
        try {
            $import = new CrmLeadsImport();
            $import->import(request()->file('csvfile'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            foreach ($failures as $failure) {
                return Response(['result' => 'error', 'message' => $failure->errors()[0] . ' of row no ' . $failure->row()]);
            }
        }

        return Response(['result'=>'success','message'=>__('Crm Leads Import Successfully')]);
    }

    public function crmLeadsExport(Request $request)
    {
        //dd($request->all());
        ini_set('max_execution_time', 300);
        //    direct download file
        $fileName = 'crm_leads_export_' . time() . '.csv';

        $response = new StreamedResponse(function () {
            $dataName = getCommonDataName();
            $conditions = request()->all();

            $fileHandle = fopen('php://output', 'w');
            fputcsv($fileHandle, ['Name', 'Mobile','National Id', 'City','Branch','Vehicle','Year','Source','Campaign','Bank Name',
                                'Purchase Plan','Monthly Salary','Preferred Appointment Time','KYC','Category','Sub Category',
                                'Created At','Type']);
            $chunkSize = 50000;

            CrmLead::search($conditions)
            ->join('customers as cust', 'crm_leads.customer_id', '=', 'cust.id')
            ->leftJoin('banks as bank', 'cust.bank_id', '=', 'bank.id')
            ->select(
                DB::raw('CONCAT(cust.first_name, " ", cust.last_name) as full_name'),
                'cust.mobile',
                'cust.national_id',
                'bank.name as bank_name',
                'crm_leads.city_id',
                'crm_leads.branch_id',
                'crm_leads.vehicle_id',
                'crm_leads.yearr',
                'crm_leads.source_id',
                'crm_leads.campaign_id',
                'crm_leads.purchase_plan',
                'crm_leads.monthly_salary',
                'crm_leads.preferred_appointment_time',
                'crm_leads.kyc',
                'crm_leads.category',
                'crm_leads.sub_category',
                'crm_leads.created_at'
            )
            ->orderBy('crm_leads.id')
            ->chunk($chunkSize, function ($records) use ($fileHandle, $dataName) {
                foreach ($records as $record) {
                    $row = [
                        $record->full_name,
                        $record->mobile,
                        $record->national_id,
                        $dataName['cities'][$record->city_id] ?? "",
                        $dataName['branches'][$record->branch_id] ?? "",
                        $dataName['vehicles'][$record->vehicle_id] ?? "",
                        $record->yearr,
                        $dataName['sources'][$record->source_id] ?? "",
                        $dataName['campaigns'][$record->campaign_id] ?? "",
                        $record->bank_name,
                        $record->purchase_plan,
                        $record->monthly_salary,
                        $record->preferred_appointment_time,
                        $record->kyc,
                        $record->category,
                        $record->sub_category,
                        formateDate($record->created_at),
                        'Crm Leads',
                    ];
                    fputcsv($fileHandle, (array)$row);
                }

                // Flush the output buffer every chunk to keep the connection alive
                ob_flush();
                flush();
            });

            fclose($fileHandle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $fileName . '"');

        return $response;
    }

}

