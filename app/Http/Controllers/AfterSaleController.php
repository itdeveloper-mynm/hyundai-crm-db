<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Branch;
use App\Models\Vehicle;
use App\Models\Source;
use App\Models\Campaign;
use App\Models\Customer;
use App\Models\Application;
use Illuminate\Support\Facades\Validator;
use App\Imports\AfterSalesImport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\DB;

class AfterSaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:after-sale-leads-list', ['only' => ['index','show']]);
        $this->middleware('permission:after-sale-leads-create', ['only' => ['create','store']]);
        $this->middleware('permission:after-sale-leads-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:after-sale-leads-delete', ['only' => ['destroy']]);
        $this->middleware('permission:after-sale-leads-import', ['only' => ['afterSaleImport']]);
        $this->middleware('permission:after-sale-leads-export', ['only' => ['afterSaleExport']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = getCommonFilterData();
        return view('admin.after_sale.after_sale_index', $data);
    }


    public function create()
    {
        $data = getCommonData();
        return view('admin.after_sale.after_sale_add' , $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Application::storeData($request,'after_sales');

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
        $after_sale= Application::findorFail($id);
        $data =getCommonData($after_sale->city_id);
        $data['after_sale'] = $after_sale;

        return view('admin.after_sale.after_sale_edit', $data);
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


    public function afterSalePagination()
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
        $types = ['online_service_booking', 'service_offers', 'contact_us','after_sales'];
        $countAll = Application::search($conditions)->whereIn('type',$types)->count();

        //-- CREATE LARAVEL PAGINATION
        $paginate =  Application::search($conditions)
                ->whereIn('type',$types)
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


    public function afterSaleImport()
    {
        try {
            $import = new AfterSalesImport();
            $import->import(request()->file('csvfile'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            foreach ($failures as $failure) {
                return Response(['result' => 'error', 'message' => $failure->errors()[0] . ' of row no ' . $failure->row()]);
            }
        }
        return Response(['result'=>'success','message'=>__('After Sales Import Successfully')]);
    }

    public function afterSaleExport(Request $request)
    {
        //dd($request->all());
        ini_set('max_execution_time', 300);
        //    direct download file
        $fileName = 'after_sales_export_' . time() . '.csv';

        $response = new StreamedResponse(function () {
            $dataName = getCommonDataName();
            $conditions = request()->all();

            $fileHandle = fopen('php://output', 'w');
            fputcsv($fileHandle, ['Name', 'Mobile', 'City','Branch','Vehicle','Source','Campaign','Bank Name',
                                'Created At','Type']);
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
                'applications.created_at'
            )
            ->whereNotNull('cust.bank_id')
            ->where('applications.type', 'after_sales')
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
                        formateDate($record->created_at),
                        'After Sales',
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
