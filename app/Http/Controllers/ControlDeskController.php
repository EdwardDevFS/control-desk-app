<?php

namespace App\Http\Controllers;

use App\Handlers\ControlDeskHandlers;
use App\Http\Requests\ControlDesk\Create;
use App\Services\ControlDeskServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControlDeskController extends Controller
{
    public function __construct(private ControlDeskServices $controlDeskServices, private ControlDeskHandlers $controlDeskHandlers)
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
            $control_information = $this->controlDeskServices->getControlDeskInformation($request);
            $control_information_counter = $this->controlDeskServices->getControlInformationCounter($request);
            $control_handled = $this->controlDeskHandlers->getInformationJsonParsed($control_information);
            $response = $this->pagination($control_handled, $request->perpage, $request->page, $control_information_counter);
            return $this->response($response, "Información de la mesa de control y administración.", 200);
        }catch(\Exception $e){
            return $this->response([], $e->getMessage(), $e->getCode());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Create $request)
    {
        DB::beginTransaction();
        try{
            $this->controlDeskServices->createControlDeskRegister($request);
            DB::commit();
            return $this->response([], "La información se ha registrado con éxito.", 201);
        }catch(\Exception $e){
            DB::rollback();
            return $this->response([], $e->getMessage(), $e->getCode());
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $register_id)
    {
        DB::beginTransaction();
        try{
            $control_information = $this->controlDeskServices->getControlDeskInformationById($register_id);
            $response = $this->controlDeskHandlers->getInformationJsonParsed($control_information);
            DB::commit();
            return $this->response($response, "Detalle de Información de la mesa de control.", 200);
        }catch(\Exception $e){
            DB::rollback();
            return $this->response([], $e->getMessage(), $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
