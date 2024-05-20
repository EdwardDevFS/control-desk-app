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
        $procedure = "CREATE PROCEDURE sp_get_control_information(
            IN p_search TEXT,
            IN p_perpage INT,
            IN p_page INT
        )
        BEGIN
            SET p_page = p_perpage * (p_page  - 1);

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
	        WHERE IF(p_search IS NULL, TRUE, CONCAT_WS(' ', cd.plu, cd.glp) LIKE CONCAT('%', CONVERT(p_search USING utf8mb4) COLLATE utf8mb4_unicode_ci, '%'))
            LIMIT p_perpage OFFSET p_page;
        END";

        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_control_information");
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
