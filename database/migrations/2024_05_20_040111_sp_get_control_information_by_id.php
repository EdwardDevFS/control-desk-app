<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $procedure = "CREATE PROCEDURE sp_get_control_information_by_id(
            IN p_register_id INT
        )
        BEGIN
            SELECT
                cd.id,
                JSON_OBJECT(
                    'glp', cd.glp,
                    'plu', cd.plu,
                    'pso', cd.pso,
                    'pre', cd.pre,
                    'dep', cd.dep,
                    'pis', cd.pis
                ) AS control_information,
                JSON_OBJECT(
                    'url', cg.url
                ) as image
            FROM control_desk cd
            LEFT JOIN control_gallery cg ON cg.control_desk_id = cd.id
            WHERE cd.id = p_register_id;
        END";

        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_control_information_by_id");
        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
