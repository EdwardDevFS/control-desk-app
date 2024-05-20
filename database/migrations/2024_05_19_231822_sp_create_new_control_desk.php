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
        $procedure = "CREATE PROCEDURE sp_create_new_control_desk(
            IN p_user_id INT,
            IN p_glp VARCHAR(16),
            IN p_plu VARCHAR(16),
            IN p_pso INT(3),
            IN p_pre INT(6) ,
            IN p_dep CHAR(2),
            IN p_pis CHAR(3)
        )
        BEGIN
            INSERT INTO control_desk (
                glp,
                plu,
                pso,
                pre,
                dep,
                pis,
                created_by,
                created_at
            ) VALUES(
                p_glp,
                p_plu,
                p_pso,
                p_pre,
                p_dep,
                p_pis,
                p_user_id,
                NOW()
            );
        END";
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_create_new_control_desk");
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
