<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TargetImport;
use App\Models\Target;

class TargetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        return view('admin.target.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }

    public function targetsPagination()
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
        $countAll = Target::count();

        //-- CREATE LARAVEL PAGINATION
        $paginate =  Target::latest()
                ->orderBy($columnName, $columnSortOrder)
                ->paginate($limit, ["*"], 'page', $page);

        $num = 1;
        $items = array();
        foreach ($paginate->items() as $idx => $row) {

            $items[] = array(
                "no" => $num,
                "id" => $row['id'],
                "date" => $row['date'],
                "count" => $row['count'] ?? 0,
                // "updated_at" => $row->updated_by ? dateTimeformat($row['updated_at']) : '-',
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


   public function importTargets()
   {
        try {
            $import = new TargetImport();
            $import->import(request()->file('csvfile'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            foreach ($failures as $failure) {
                return Response(['result' => 'error', 'message' => $failure->errors()[0] . ' of row no ' . $failure->row()]);
            }
        }

        return Response(['result'=>'success','message'=>__('Target Data Import Successfully')]);
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
                                'Purchase Plan','Monthly Salary','Preferred Appointment Time','Created At','Type','Category','Sub Category']);
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

}
