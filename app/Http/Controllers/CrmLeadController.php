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
use App\Mail\RecordDetailsMail;
use Illuminate\Support\Facades\Mail;
use App\Services\AutoLineService;

class CrmLeadController extends Controller
{
    protected $apiService;
    public function __construct(AutoLineService $apiService)
    {
        $this->middleware('auth');
        $this->middleware('permission:crm-leads-list', ['only' => ['index','show']]);
        $this->middleware('permission:crm-leads-create', ['only' => ['create','store']]);
        $this->middleware('permission:crm-leads-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:crm-leads-delete', ['only' => ['destroy']]);
        $this->middleware('permission:crm-leads-import', ['only' => ['crmleadsImport']]);
        $this->middleware('permission:crm-leads-export', ['only' => ['crmleadsExport']]);
        $this->apiService = $apiService;
    }
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        // dd(sendSmsPdPl('+923125115216'));
        $data = getCommonFilterData(null,'sales');

        return view('admin.crn_lead.index' ,$data);
    }

    public function qualifiedCrmLeads()
    {
        $data = getCommonFilterData(null,'sales');

        return view('admin.crn_lead.qualified_index' ,$data);
    }

    public function nonQualifiedCrmLeads()
    {
        $data = getCommonFilterData(null,'sales');

        return view('admin.crn_lead.non_qualified_index' ,$data);
    }

    public function generalCrmLeads()
    {
        $data = getCommonFilterData(null,'sales');

        return view('admin.crn_lead.general_index' ,$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $data = getCommonData(null,'sales');

        return view('admin.crn_lead.add' , $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Application::storeData($request,'crm_leads');

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

        $lead = Application::findorFail($id);
        $data = getCommonData($lead->city_id ,'sales');
        $data['lead'] = $lead;

        return view('admin.crn_lead.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        Application::updateData($request,$id);

        return Response(['result'=>'success','message'=>__('Updated Successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $row = Application::findorFail($id);
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

          // Check if the request has a mobile input
        // if (empty($searchValue)) {
        //     // Return empty data if mobile input is not present
        //     return response()->json([
        //         "draw" => (int)$draw,
        //         "recordsTotal" => 0,
        //         "recordsFiltered" => 0,
        //         "data" => [],
        //     ]);
        // }

        //-- WE MUST HAVE COUNT ALL RECORDS WITHOUT ANY FILTERS
        $countAll = Application::search($conditions)->count();

        //-- CREATE LARAVEL PAGINATION
        $paginate =  Application::search($conditions)
                //->where('type','crm_leads')
                ->latest()
                ->orderBy($columnName, $columnSortOrder)
                ->paginate($limit, ["*"], 'page', $page);

        $num = 1;
        $items = array();
        foreach ($paginate->items() as $idx => $row) {
            // dd($row->customer->full_name);
            $items[] = array(
                "no" => $num,
                "id" => $row['id'],
                "full_name" => $row->customer ? ucwords($row->customer->full_name) : "",
                "mobile" => $row->customer->mobile ?? '-',
                // "first_name" => ucwords($row->customer->first_name),
                // "last_name" => ucwords($row->customer->last_name),
                "city_id" => $row->city->name ?? "",
                "branch_id" => $row->branch->name ?? "",
                "vehicle_id" => $row->vehicle->name ?? "",
                "source_id" => $row->source->name ?? "",
                "campaign_id" => $row->campaign->name ?? "",
                "type" => reverseCheckApplicationType($row->type) == 'Crm Leads' ? 'Inbound': reverseCheckApplicationType($row->type),
                "category" => $row['category'] ?? "-",
                "sub_category" => $row['sub_category'] ?? "-",
                "created_at" => dateTimeformat($row['created_at']),
                "created_by" => $row->createdby->name ?? 'System',
                "updated_at" => $row->updated_by ? dateTimeformat($row['updated_at']) : '-',
                "updated_by" => $row->updatedby->name ?? '-',
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

   public function subCategoryUpdate(Request $request) {
        // dd($request->all());
        $id =$request->rowid;
        $application = Application::findorFail($id);
        $application->category = $request->action_category;
        $application->sub_category = $request->action_sub_category;

        if($request->action_category == 'Qualified'){
            $application->qualified_date = now();
        }

        $application->save();

        if($request->action_category == 'Qualified'){
            // autoLineAPI($application);
            $response = $this->apiService->callApi($application); // Call the third-party API
            // dd($response);
        }

        // Fetch the record from the database with joins
        // $record = DB::table('applications')
        // ->select(
        //     'applications.id as id',
        //     'campaigns.name as Campaign',
        //     'applications.type as DataType',
        //     'customers.gender as Gender',
        //     'customers.first_name as FirstName',
        //     'customers.last_name as LastName',
        //     'customers.national_id as NationalID',
        //     'customers.mobile as Mobile',
        //     'customers.email as Email',
        //     'cities.name as DealerCity',
        //     'branches.name as DealerBranch',
        //     'applications.request_date as RequestDate',
        //     'applications.preferred_appointment_time as PreferredTime',
        //     'vehicles.name as Vehicle',
        //     'applications.yearr as Year',
        //     'applications.intention as PurchasePlan',
        //     'applications.monthly_salary as MonthlySalary',
        //     'banks.name as Bank',
        //     'applications.comments as Comments',
        //     'sources.name as Source',
        //     'applications.category as Category',
        //     'applications.sub_category as SubCategory'
        // )
        // ->join('customers', 'applications.customer_id', '=', 'customers.id')
        // ->join('cities', 'applications.city_id', '=', 'cities.id')
        // ->join('branches', 'applications.branch_id', '=', 'branches.id')
        // ->join('vehicles', 'applications.vehicle_id', '=', 'vehicles.id')
        // ->join('sources', 'applications.source_id', '=', 'sources.id')
        // ->leftjoin('campaigns', 'applications.campaign_id', '=', 'campaigns.id')
        // ->leftjoin('banks', 'customers.bank_id', '=', 'banks.id')
        // ->where('applications.id', $id)
        // ->first();


    // Convert the record to an array
    // $record = (array) $record;
    // $record['DataType'] = reverseCheckApplicationType($record['DataType']);
    // dd($record);
    // Send the email
    // $recipients = ['ateeb@sohoby.sa','ahmad@sohoby.sa'];
    // $recipients = ['ateeb@sohoby.sa'];
    // $recipients = ['hyundai.crm@hyundai.mynaghi.com'];

        // try {
        //     // Mail::to($recipients)->send(new RecordDetailsMail($record));
        //     // Mail::to('hyundai.crm@hyundai.mynaghi.com')->send(new RecordDetailsMail($record));
        //     // Email sent successfully
        //     return response()->json(['status' => 'success', 'message' => 'Email sent successfully.']);
        // } catch (\Exception $e) {
        //     // Failed to send email
        //     return response()->json(['status' => 'error', 'message' => 'Failed to send email.', 'error' => $e->getMessage()]);
        // }


        return Response(['result'=>'success','message'=>__('Updated Successfully')]);

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
        // $data = $request->all();

        // foreach ($data as $key => $value) {
        //     if (is_array($value) && count($value) === 1 && $value[0] === null) {
        //         $request->request->remove($key);
        //     }
        // }

        //dd($request->all());
        ini_set('max_execution_time', 300);
        //    direct download file
        $fileName = 'crm_leads_export_' . time() . '.csv';

        $response = new StreamedResponse(function () {
            $dataName = getCommonDataName();
            $conditions = request()->all();

            $fileHandle = fopen('php://output', 'w');
            // Add UTF-8 BOM for Excel compatibility
            fwrite($fileHandle, "\xEF\xBB\xBF");
            fputcsv($fileHandle, ['Name', 'Mobile','National Id', 'City','Branch','Vehicle','Year','Source','Campaign','Bank Name',
                                'Purchase Plan','Monthly Salary','Preferred Appointment Time','KYC','Category','Sub Category',
                                'Created At','Type','CRM User Name']);
            $chunkSize = 50000;

            Application::search($conditions)
            ->join('customers as cust', 'applications.customer_id', '=', 'cust.id')
            ->leftJoin('users as upduser', 'applications.updated_by', '=', 'upduser.id')
            ->leftJoin('banks as bank', 'cust.bank_id', '=', 'bank.id')
            ->select(
                DB::raw('CONCAT(cust.first_name, " ", cust.last_name) as full_name'),
                'cust.mobile',
                'cust.national_id',
                'upduser.name as crm_user_upd_name',
                'bank.name as bank_name',
                'applications.city_id',
                'applications.branch_id',
                'applications.vehicle_id',
                'applications.yearr',
                'applications.source_id',
                'applications.campaign_id',
                'applications.purchase_plan',
                'applications.monthly_salary',
                'applications.preferred_appointment_time',
                'applications.kyc',
                'applications.category',
                'applications.sub_category',
                'applications.created_at',
                'applications.type',
            )
            ->orderBy('applications.id' , 'DESC')
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
                        reverseCheckApplicationType($record->type),
                        $record->crm_user_upd_name ?? "",
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

