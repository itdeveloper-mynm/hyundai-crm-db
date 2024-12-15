<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Vehicle;
use App\Models\Source;
use App\Models\Customer;
use App\Models\Application;
use Illuminate\Support\Facades\Validator;
use App\Imports\SmoLeadsImport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\DB;

class SmoLeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:smo-leads-list', ['only' => ['index','show']]);
        $this->middleware('permission:smo-leads-create', ['only' => ['create','store']]);
        $this->middleware('permission:smo-leads-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:smo-leads-delete', ['only' => ['destroy']]);
        $this->middleware('permission:smo-leads-import', ['only' => ['smoLeadImport']]);
        $this->middleware('permission:smo-leads-export', ['only' => ['smoLeadExport']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = getCommonFilterData(null,'sales');
        return view('admin.smo_lead.smo_lead_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = getCommonData(null,'sales');
        return view('admin.smo_lead.smo_lead_add' , $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Application::storeData($request,'smo_leads');

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
        $data = getCommonData(null,'sales');
        $data['smo_lead']= Application::findorFail($id);

        return view('admin.smo_lead.smo_lead_edit', $data);
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


    public function smoLeadPagination()
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

        //-- WE MUST HAVE COUNT ALL RECORDS WITHOUT ANY FILTERS
        $countAll = Application::search($conditions)->where('type','smo_leads')->count();

        //-- CREATE LARAVEL PAGINATION
        $paginate =  Application::search($conditions)
                ->latest()
                ->where('type','smo_leads')
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
                "vehicle_id" => $row->vehicle->name ?? "",
                "source_id" => $row->source->name ?? "",
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

   public function smoLeadImport(){
        try {
            $import = new SmoLeadsImport();
            $import->import(request()->file('csvfile'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            foreach ($failures as $failure) {
                return Response(['result' => 'error', 'message' => $failure->errors()[0] . ' of row no ' . $failure->row()]);
            }
        }

        return Response(['result'=>'success','message'=>__('Smo Leads Import Successfully')]);
    }


    public function smoLeadExport(Request $request)
    {
        //dd($request->all());
        ini_set('max_execution_time', 300);
        //    direct download file
        $fileName = 'smo_leads_export_' . time() . '.csv';

        $response = new StreamedResponse(function () {
            $dataName = getCommonDataName();
            $conditions = request()->all();

            $fileHandle = fopen('php://output', 'w');
            fputcsv($fileHandle, ['Name', 'Mobile','City','Vehicle','Source','Bank Name','Created At','Type']);
            $chunkSize = 50000;

            Application::search($conditions)
            ->join('customers as cust', 'applications.customer_id', '=', 'cust.id')
            ->leftJoin('banks as bank', 'cust.bank_id', '=', 'bank.id')
            ->select(
                DB::raw('CONCAT(cust.first_name, " ", cust.last_name) as full_name'),
                'cust.mobile',
                'bank.name as bank_name',
                'applications.city_id',
                'applications.vehicle_id',
                'applications.source_id',
                'applications.created_at'
            )
            ->whereNotNull('cust.bank_id')
            ->where('applications.type', 'leads')
            ->orderBy('applications.id')
            ->chunk($chunkSize, function ($records) use ($fileHandle, $dataName) {
                foreach ($records as $record) {
                    $row = [
                        $record->full_name,
                        $record->mobile,
                        $dataName['cities'][$record->city_id] ?? "",
                        $dataName['vehicles'][$record->vehicle_id] ?? "",
                        $dataName['sources'][$record->source_id] ?? "",
                        $record->bank_name,
                        formateDate($record->created_at),
                        'Smo Leads',
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
