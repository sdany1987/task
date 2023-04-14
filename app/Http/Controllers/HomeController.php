<?php

namespace App\Http\Controllers;

use App\Models\Risk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $risks = Risk::where('status', 1)->where('assigned_to', auth()->user()->id)->get();        
        return view('home', compact('risks'));
    }

    public function CreateRisk()
    {
        return view('addrisk');
    }
    public function editRiskDet($id, $types)
    {
        $view_risk = Risk::find($id);

        return view('editRiskDet', compact('view_risk', 'types'));
    }
    public function AdminRisk(Request $request)
    {
        // $risks = Risk::where('status', 1)->where('assigned_to', 0)->get();
        $req_val = $request->all();
        $risks = Risk::where('status', 1)->where('assigned_to', 0);
        if (isset($req_val['risk_search_val'])) {
            if ($req_val['risk_status_val'] == 1) {
                $risks->where('name', 'like', '%' . $req_val['risk_search_val'] . '%');
            } else if ($req_val['risk_status_val'] == 0) {
                $risks->where('description', 'like', '%' . $req_val['risk_search_val'] . '%');
            }
        }
        $risks = $risks->get();
        // print_r($risks);
        // die;
        return view('adminriskview', compact('risks'));
    }

    public function RiskPost(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $name = $request->name ?? '';
        $description = $request->description ?? '';

        $risk = new Risk();
        $risk->name = $name;
        $risk->description = $description;
        $risk->created_by = 2;  //1 - admin
        $risk->user_id = auth()->user()->id ?? 0;
        $risk->assigned_to = auth()->user()->id ?? 0;
        $risk->status = 1;
        // $risk->save();

        $savetype = $request->savetypes ?? 2;
        $saveid = $request->saveid ?? '';
        if ($savetype == '3') {
            $msg = 'Risk has been updated successfully';
            // $risk->update($saveid);
            $dataUpdate = [
                'name' => $name,
                'description' => $description,
                'created_by' => 2,
                'user_id' => auth()->user()->id ?? 0,
                'status' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            Risk::where('id', $saveid)->update($dataUpdate);
        } else {
            $msg = 'Risk has been created successfully';
            $risk->save();
        }

        // $msg = 'Risk has been created successfully';
        // if ($savetype == '1') {
        //     return redirect()->route('admin.risk.create')->with('success', $msg);
        // } else {
        return redirect()->route('home')->with('success', $msg);
        // }
    }

    public function AdminSearch(Request $request)
    {
        $req_val = $request->all();
        $risks = Risk::where('status', 1)->where('assigned_to', 0);
        // if(isset($req_val['risk_search_val'])){                
        // }
        if (isset($req_val['risk_search_val'])) {
            if ($req_val['risk_status_val'] == 1) {
                $risks->where('name', 'like', '%' . $req_val['risk_search_val'] . '%');
            } else if ($req_val['risk_status_val'] == 0) {
                $risks->where('description', 'like', '%' . $req_val['risk_search_val'] . '%');
            }
        }
        $risks = $risks->get();
        // print_r(count($risks));
        // die;
        $returnHTML   = view('searchrisk')->with(array('page' => 'searchrisk', 'risks' => $risks))->render();
        return response()->json(array('success' => '200', 'response_html' => $returnHTML));
    }

    public function ViewRisk(Request $request)
    {
        $req_val = $request->all();
        $id = $req_val['id'] ?? '';
        $view_risk = Risk::find($id);
        // $cont_det  =   DB::table('contactus_mail_data')->where('id', $id)->get()->first();
        $returnHTML   = view('admin.viewrisk')->with(array('page' => 'viewrisk', 'viewrisk' => $view_risk))->render();
        return response()->json(array('success' => '200', 'response_html' => $returnHTML));
    }

    public function DeleteRisk()
    {
        $data = request()->all();
        $deleteid = $data['id'];
        $del_risk = Risk::find($deleteid);
        $dataUpdate = [
            'status' => 2,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        // $delete = $del_risk->update($dataUpdate);
        $delete = Risk::where('id', $deleteid)->update($dataUpdate);
        if ($delete) {
            echo "1";
        } else {
            echo  "2";
        }
    }

    public function AssignRisk()
    {
        $data = request()->all();
        $deleteid = $data['id'];
        $del_risk = Risk::find($deleteid);
        $dataUpdate = [
            'assigned_to' => auth()->user()->id ?? 0,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        // $delete = $del_risk->update($dataUpdate);
        $delete = Risk::where('id', $deleteid)->update($dataUpdate);
        if ($delete) {
            echo "1";
        } else {
            echo  "2";
        }
    }
}
