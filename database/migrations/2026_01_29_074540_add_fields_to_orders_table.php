<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'shipping_address_id')) {
                $table->foreignId('shipping_address_id')->nullable()->after('user_id')->constrained()->onDelete('set null');
            }
            
            if (!Schema::hasColumn('orders', 'coupon_code')) {
                $table->string('coupon_code')->nullable()->after('total');
            }
            
            if (!Schema::hasColumn('orders', 'discount_amount')) {
                $table->decimal('discount_amount', 10, 2)->default(0)->after('total');
            }
            
            if (!Schema::hasColumn('orders', 'shipping_cost')) {
                $table->decimal('shipping_cost', 10, 2)->default(0)->after('total');
            }
            
            if (!Schema::hasColumn('orders', 'payment_method')) {
                $table->enum('payment_method', ['cod', 'online'])->default('cod')->after('status');
            }
            
            if (!Schema::hasColumn('orders', 'tracking_number')) {
                $table->string('tracking_number')->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'shipping_address_id')) {
                $table->dropForeign(['shipping_address_id']);
                $table->dropColumn('shipping_address_id');
            }
            
            $columnsToCheck = ['coupon_code', 'discount_amount', 'shipping_cost', 'payment_method', 'tracking_number'];
            foreach ($columnsToCheck as $column) {
                if (Schema::hasColumn('orders', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
