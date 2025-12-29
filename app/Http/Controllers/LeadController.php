<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Customer;
use App\Models\Branch;
use Illuminate\Support\Facades\Validator;
use App\Imports\LeadsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\City;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

class LeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:campaign-leads-list', ['only' => ['index','show']]);
        $this->middleware('permission:campaign-leads-create', ['only' => ['create','store']]);
        $this->middleware('permission:campaign-leads-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:campaign-leads-delete', ['only' => ['destroy']]);
        $this->middleware('permission:campaign-leads-import', ['only' => ['leadsImport']]);
        $this->middleware('permission:campaign-leads-export', ['only' => ['leadsExport']]);

        $this->middleware('permission:all-leads-list', ['only' => ['allleads_index']]);
        $this->middleware('permission:all-leads-export', ['only' => ['allleadsExport']]);

    }
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $data = getCommonFilterData(null,'sales');
        return view('admin.lead.lead_index' ,$data);
    }

    public function allleads_index()
    {
        $data = getCommonFilterData();
        return view('admin.lead.allleads_index' ,$data);
    }


    // public function leadsExport()
    // {
    //    work prefectly first store and returning file
    //     $fileName = 'export_' . time() . '.csv';
    //     $filePath = storage_path('app/' . $fileName);

    //     // Open a file handle to write to the file in the storage
    //     $fileHandle = fopen($filePath, 'w+');

    //     $columns = ['column1', 'column2', 'column3'];
    //     // Write the headers if needed
    //     fputcsv($fileHandle, $columns);

    //     // Optimize chunk size based on memory and performance testing
    //     $chunkSize = 50000;

    //     Application::chunk($chunkSize, function($records) use ($fileHandle) {
    //             foreach ($records as $record) {
    //                 fputcsv($fileHandle, $record->toArray());
    //             }
    //         });

    //     // Close the file handle
    //     fclose($fileHandle);

    //     // Return the file as a response for download
    //     return response()->download($filePath, $fileName, [
    //         'Content-Type' => 'text/csv',
    //         'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
    //     ])->deleteFileAfterSend(true);
    // }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $data = getCommonData(null,'sales');

        return view('admin.lead.lead_add' , $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Application::storeData($request,'leads');

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
        $data = getCommonData($lead->city_id,'sales');
        $data['lead'] = $lead;

        return view('admin.lead.lead_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

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

    public function deletebulkRecords(Request $request)
    {
        // dd($request->all());
        $row = Application::whereIn('id',$request->ids)->delete();

        return Response(['result'=>'success','message'=>__('Deleted Successfully')]);
    }


    public function leadsPagination()
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
        $countAll = Application::search($conditions)->whereIn('type',['leads','special_offers'])->count();

        //-- CREATE LARAVEL PAGINATION
        $paginate =  Application::search($conditions)
                // ->where('type','leads')
                ->whereIn('type',['leads','special_offers'])
                ->latest()
                ->orderBy($columnName, $columnSortOrder)
                ->paginate($limit, ["*"], 'page', $page);

        $num = 1;
        $items = array();
        foreach ($paginate->items() as $idx => $row) {

            $items[] = array(
                "no" => $num,
                "id" => $row['id'],
                "full_name" => ucwords($row->customer->full_name),
                "mobile" => $row->customer->mobile ?? '-',
                // "first_name" => ucwords($row->customer->first_name),
                // "last_name" => ucwords($row->customer->last_name),
                "customer_id" => $row->customer_id,
                "city_id" => $row->city->name ?? "",
                "branch_id" => $row->branch->name ?? "",
                "vehicle_id" => $row->vehicle->name ?? "",
                "source_id" => $row->source->name ?? "",
                "campaign_id" => $row->campaign->name ?? "",
                "category" => $row['category'] ?? "-",
                "sub_category" => $row['sub_category'] ?? "-",
                "type" => reverseCheckApplicationType($row['type']),
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

    public function allleadsPagination()
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
            $countAll = Application::search($conditions)
            ->count();

            //-- CREATE LARAVEL PAGINATION
            $paginate =  Application::search($conditions)
                    ->latest()
                    ->orderBy($columnName, $columnSortOrder)
                    ->paginate($limit, ["*"], 'page', $page);

            $num = 1;
            $items = array();
            foreach ($paginate->items() as $idx => $row) {

                $items[] = array(
                    "no" => $num,
                    "id" => $row['id'],
                    "full_name" => ucwords($row->customer->full_name),
                    "mobile" => $row->customer->mobile ?? '-',
                    // "first_name" => ucwords($row->customer->first_name),
                    // "last_name" => ucwords($row->customer->last_name),
                    "customer_id" => $row->customer_id,
                    // "city_id" => Auth::user()->hasRole('SuperAdmin') ? $row->city_id : $row->city->name ?? "",
                    // "branch_id" => Auth::user()->hasRole('SuperAdmin') ? $row->branch_id : $row->branch->name ?? "",
                    // "vehicle_id" => Auth::user()->hasRole('SuperAdmin') ? $row->vehicle_id : $row->vehicle->name ?? "",
                    // "source_id" => Auth::user()->hasRole('SuperAdmin') ? $row->source_id : $row->source->name ?? "",
                    // "campaign_id" => Auth::user()->hasRole('SuperAdmin') ? $row->campaign_id : $row->campaign->name ?? "",
                    "city_id" => $row->city->name ?? "",
                    "branch_id" => $row->branch->name ?? "",
                    "vehicle_id" => $row->vehicle->name ?? "",
                    "source_id" => $row->source->name ?? "",
                    "campaign_id" => $row->campaign->name ?? "",
                    "category" => $row['category'] ?? "-",
                    "sub_category" => $row['sub_category'] ?? "-",
                    "type" => reverseCheckApplicationType($row['type']),
                    "chk_type" => $row['type'],
                    "submit_count" => $row['submit_count'] ?? 1,
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

   public function leadsImport()
   {
        try {
            $import = new LeadsImport();
            $import->import(request()->file('csvfile'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            foreach ($failures as $failure) {
                return Response(['result' => 'error', 'message' => $failure->errors()[0] . ' of row no ' . $failure->row()]);
            }
        }

        if (request()->has('select_date')) {
            return Response(['result'=>'success','message'=>__('Old Leads Import Successfully')]);
        }
        return Response(['result'=>'success','message'=>__('Leads Import Successfully')]);
    }


    public function leadsExport(Request $request)
    {
        //dd($request->all());
        ini_set('max_execution_time', 300);
        //    direct download file
        $fileName = 'leads_export_' . time() . '.csv';

        $response = new StreamedResponse(function () {
            $dataName = getCommonDataName();
            $conditions = request()->all();

            $fileHandle = fopen('php://output', 'w');

            // Add UTF-8 BOM for Excel compatibility
            fwrite($fileHandle, "\xEF\xBB\xBF");

            fputcsv($fileHandle, ['Name', 'Mobile', 'City','Branch','Vehicle','Source','Campaign','Bank Name',
                                'Purchase Plan','Monthly Salary','Preferred Appointment Time','Created At','Category','Sub Category','Type','INV']);
            $chunkSize = 50000;

            Application::search($conditions)
            ->join('customers as cust', 'applications.customer_id', '=', 'cust.id')
            ->leftJoin('banks as bank', 'cust.bank_id', '=', 'bank.id')
            ->select(
                DB::raw('CONCAT(cust.first_name, " ", cust.last_name) as full_name'),
                'cust.mobile',
                'bank.name as bank_name',
                'applications.city_id',
                'applications.branch_id',
                'applications.vehicle_id',
                'applications.source_id',
                'applications.campaign_id',
                'applications.purchase_plan',
                'applications.monthly_salary',
                'applications.preferred_appointment_time',
                'applications.created_at',
                'applications.category',
                'applications.sub_category',
                'applications.type',
                DB::raw('(CASE WHEN EXISTS (SELECT 1 FROM sales_data WHERE sales_data.customer_id = applications.customer_id) THEN 1 ELSE 0 END) as inv')
                )
            // ->whereNotNull('cust.bank_id')
            // ->where('applications.type', 'leads')
            ->whereIn('applications.type',['leads','special_offers'])
            ->orderBy('applications.id')
            ->chunk($chunkSize, function ($records) use ($fileHandle, $dataName) {
                foreach ($records as $record) {
                    $row = [
                        $record->full_name,
                        $record->mobile,
                        $dataName['cities'][$record->city_id] ?? "",
                        $dataName['branches'][$record->branch_id] ?? "",
                        $dataName['vehicles'][$record->vehicle_id] ?? "",
                        $dataName['sources'][$record->source_id] ?? "",
                        $dataName['campaigns'][$record->campaign_id] ?? "",
                        $record->bank_name,
                        $record->purchase_plan,
                        $record->monthly_salary,
                        $record->preferred_appointment_time,
                        formateDate($record->created_at),
                        $record->category,
                        $record->sub_category,
                        reverseCheckApplicationType($record->type),
                        $record->inv ?? 0,
                    ];
                    fputcsv($fileHandle, (array)$row);
                }

                // Flush the output buffer every chunk to keep the connection alive
                ob_flush();
                flush();
            });

            fclose($fileHandle);

                // DB::table('applications as app')
                // ->join('customers as cust', 'app.customer_id', '=', 'cust.id')
                // ->join('banks as bank', 'cust.bank_id', '=', 'bank.id')
                // ->select(DB::raw('CONCAT(cust.first_name, " ", cust.last_name) as full_name'),'cust.mobile', 'bank.name as bank_name',
                // 'app.city_id','app.branch_id','app.vehicle_id','app.source_id','app.campaign_id','app.purchase_plan','app.monthly_salary',
                // 'app.preferred_appointment_time','app.created_at')
                // //->select(DB::raw('CONCAT(cust.first_name, " ", cust.last_name) as full_name'), 'bank.name as bank_name', 'app.*')
                // ->whereNotNull('cust.bank_id')
                // ->where('type','leads')
                // ->orderBy('app.id')
                // ->chunk($chunkSize, function ($records) use ($fileHandle,$dataName) {
                //     foreach ($records as $record) {
                //         $row = [
                //             $record->full_name,
                //             $record->mobile,
                //             $dataName['cities'][$record->city_id] ?? "",
                //             $dataName['branches'][$record->branch_id] ?? "",
                //             $dataName['vehicles'][$record->vehicle_id] ?? "",
                //             $dataName['sources'][$record->source_id] ?? "",
                //             $dataName['campaigns'][$record->campaign_id] ?? "",
                //             $record->bank_name,
                //             $record->purchase_plan,
                //             $record->monthly_salary,
                //             $record->preferred_appointment_time,
                //             formateDate($record->created_at),
                //             'Leads',
                //         ];
                //         fputcsv($fileHandle, (array) $row);
                //         //fputcsv($fileHandle, (array) $record);
                //     }

                //      // Flush the output buffer every chunk to keep the connection alive
                //     ob_flush();
                //     flush();
                // });

            //fclose($fileHandle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $fileName . '"');

        return $response;
    }


    public function allleadsExport(Request $request)
    {
        //dd($request->all());
        ini_set('max_execution_time', 300);
        //    direct download file
        $fileName = 'all_leads_export_' . time() . '.csv';

        $response = new StreamedResponse(function () {
            $dataName = getCommonDataName();
            $conditions = request()->all();

            $fileHandle = fopen('php://output', 'w');

            // Add UTF-8 BOM for Excel compatibility
            fwrite($fileHandle, "\xEF\xBB\xBF");

            fputcsv($fileHandle, ['Name', 'Mobile', 'City','Branch','Vehicle','Source','Campaign','Bank Name',
                                'Purchase Plan','Monthly Salary','Preferred Appointment Time','Created At','Type','Category','Sub Category','INV']);
            $chunkSize = 50000;

            Application::search($conditions)
            ->join('customers as cust', 'applications.customer_id', '=', 'cust.id')
            ->leftJoin('banks as bank', 'cust.bank_id', '=', 'bank.id')
            ->select(
                DB::raw('CONCAT(cust.first_name, " ", cust.last_name) as full_name'),
                'cust.mobile',
                'bank.name as bank_name',
                'applications.city_id',
                'applications.branch_id',
                'applications.vehicle_id',
                'applications.source_id',
                'applications.campaign_id',
                'applications.purchase_plan',
                'applications.monthly_salary',
                'applications.preferred_appointment_time',
                'applications.created_at',
                'applications.type',
                'applications.category',
                'applications.sub_category',
                DB::raw('(CASE WHEN EXISTS (SELECT 1 FROM sales_data WHERE sales_data.customer_id = applications.customer_id) THEN 1 ELSE 0 END) as inv')
            )
            // ->whereNotNull('cust.bank_id')
            ->orderBy('applications.id')
            ->latest()
            ->chunk($chunkSize, function ($records) use ($fileHandle, $dataName) {
                foreach ($records as $record) {
                    $row = [
                        $record->full_name,
                        $record->mobile,
                        $dataName['cities'][$record->city_id] ?? "",
                        $dataName['branches'][$record->branch_id] ?? "",
                        $dataName['vehicles'][$record->vehicle_id] ?? "",
                        $dataName['sources'][$record->source_id] ?? "",
                        $dataName['campaigns'][$record->campaign_id] ?? "",
                        $record->bank_name,
                        $record->purchase_plan,
                        $record->monthly_salary,
                        $record->preferred_appointment_time,
                        formateDate($record->created_at),
                        reverseCheckApplicationType($record->type),
                        $record->category,
                        $record->sub_category,
                        $record->inv ?? 0,
                    ];
                    fputcsv($fileHandle, (array)$row);
                }

                // Flush the output buffer every chunk to keep the connection alive
                ob_flush();
                flush();
            });

            fclose($fileHandle);
        });

        // $response->headers->set('Content-Type', 'text/csv');

        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $fileName . '"');

        return $response;
    }

    public function updateColumn(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:applications,id',
            'column' => 'required|string|in:city_id,branch_id,vehicle_id,source_id,campaign_id',
            'value' => 'required',
        ]);

        $lead = Application::find($request->id);
        $lead->{$request->column} = $request->value;
        if($request->column == 'city_id'){
            $lead->branch_id = Branch::where('city_id',$request->value)->first()->id ?? null;
        }
        $lead->save();

        return response()->json(['message' => 'Column updated successfully!'], 200);
    }

    public function updateAllData(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'city_id' => 'nullable|exists:cities,id',
            'branch_id' => [
                'nullable',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value && $request->dealerCity) {
                        $city = \App\Models\City::where('id', $request->city_id)->first();
                        $branchExists = \App\Models\Branch::where('name', $value)
                                            ->where('city_id', $city->id ?? null)
                                            ->exists();

                        if (!$branchExists) {
                            $fail(__('The selected branch does not belong to the selected dealer city.'));
                        }
                    }
                },
            ],
        ]);

        if($validator->fails()){
            return response()->json(['result'=>'error', 'message' => $validator->errors()->first()]);
        }
            // Decode checked values from JSON string
        $checkedValues = json_decode($request->checked_values, true);

        if(count($checkedValues) <= 0 ){
            return response()->json(['result'=>'error', 'message' => 'Select rows to update data']);
        }
        // Filter out empty or null values from the request
        $updateData = array_filter($request->only(['city_id', 'branch_id', 'vehicle_id', 'source_id', 'campaign_id','type']));
        // dd($checkedValues,$updateData);
        // Ensure that we have some data to update
        if (!empty($updateData)) {
            // Update the records where ID is in $checkedValues
            DB::table('applications')
                ->whereIn('id', $checkedValues)
                ->update($updateData);

            return response()->json(['result'=>'success', 'message' => 'Records updated successfully']);
        }

        return response()->json(['result'=>'error', 'message' => 'No valid data to update']);

    }


}
