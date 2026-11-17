<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('procurement_requests', function (Blueprint $table): void {
            $table->id();
$table->uuid('reference')->unique();
            $table->morphs('requester');
            $table->nullableMorphs('account');
            $table->string('title');
            $table->longText('justification')->nullable();
            $table->string('status')->default('draft')->index();
            $table->string('currency', 3)->default('USD');
            $table->date('needed_by')->nullable();
            $table->decimal('estimated_total', 14, 2)->default(0);
            $table->nullableMorphs('reviewer');
            $table->timestamp('reviewed_at')->nullable();
            $table->text('decision_notes')->nullable();
            $table->string('purchase_order_reference')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('procurement_request_items', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('procurement_request_id')->constrained('procurement_requests')->cascadeOnDelete();
            $table->string('description');
            $table->decimal('quantity', 14, 4)->default(1);
            $table->decimal('estimated_unit_cost', 14, 2)->default(0);
            $table->decimal('estimated_total', 14, 2)->default(0);
            $table->unsignedInteger('position')->default(0);
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

    }

    public function down(): void
    {
Schema::dropIfExists('procurement_request_items');
        Schema::dropIfExists('procurement_requests');
    }
};
