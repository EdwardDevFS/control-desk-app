<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ControlDeskServices
{
    public function getControlDeskInformation(object $input): array
    {
        try {
            $procedure = "CALL sp_get_control_information(?,?,?)";
            $params = [
                $input->search,
                $input->perpage,
                $input->page
            ];
            return DB::select($procedure, $params);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getControlDeskInformationById(string $register_id): object
    {
        try {
            $procedure = "CALL sp_get_control_information_by_id(?)";
            $params = [
                $register_id
            ];
            return DB::selectOne($procedure, $params);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function createControlDeskRegister(object $input): void
    {
        try {
            $procedure = "CALL sp_create_new_control_desk(?,?,?,?,?,?,?)";
            $params = [
                1,
                $input->glp,
                $input->plu,
                $input->pso,
                $input->pre,
                $input->dep??'LM',
                $input->pis??'PER'
            ];
            DB::statement($procedure, $params);
            return;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getControlInformationCounter(object $input): int
    {
        try {
            $query = "SELECT COUNT(*) AS `counter` FROM control_desk cd WHERE IF(? IS NULL, TRUE,CONCAT_WS(' ', cd.plu, cd.glp) LIKE CONCAT('%',?,'%'))";
            $params = [
                $input->search,
                $input->search
            ];
            return DB::selectOne($query, $params)->counter??0;
        } catch (\Throwable $th) {
            throw $th;
        }
    }



}
