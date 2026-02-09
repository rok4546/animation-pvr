<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Check and add columns only if they don't exist
            if (!Schema::hasColumn('products', 'anime_collection_id')) {
                $table->foreignId('anime_collection_id')->nullable()->after('category_id')->constrained('anime_collections')->onDelete('set null');
            }
            
            if (!Schema::hasColumn('products', 'stock_quantity')) {
                $table->integer('stock_quantity')->default(0)->after('stock');
            }
            
            if (!Schema::hasColumn('products', 'is_new_arrival')) {
                $table->boolean('is_new_arrival')->default(false)->after('is_featured');
            }
            
            if (!Schema::hasColumn('products', 'views_count')) {
                $table->integer('views_count')->default(0)->after('is_active');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'anime_collection_id')) {
                $table->dropForeign(['anime_collection_id']);
                $table->dropColumn('anime_collection_id');
            }
            
            $columnsToCheck = ['stock_quantity', 'is_new_arrival', 'views_count'];
            foreach ($columnsToCheck as $column) {
                if (Schema::hasColumn('products', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
