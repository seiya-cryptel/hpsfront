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
        Schema::create('return_t_accept', function (Blueprint $table) {
            $table->id();
            $table->string('accept_no', 9)->nullable()->unique()->default(NULL);
            $table->string('order_id', 15);
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('login_id', 20)->unique();
            $table->string('password', 20)->nullable()->default(NULL);
            $table->tinyInteger('request_content_class')->nullable()->default(0);
            $table->tinyInteger('status')->nullable()->default(0);
            $table->tinyInteger('input_source')->nullable()->default(0);
            $table->string('tanto_input', 20)->nullable()->default(NULL);
            $table->string('invoice_no', 20)->nullable()->default(NULL);
            $table->string('post', 8)->nullable()->default(NULL);
            $table->string('ken', 8)->nullable()->default(NULL);
            $table->string('address', 200)->nullable()->default(NULL);
            $table->string('company', 200)->nullable()->default(NULL);
            $table->string('division', 200)->nullable()->default(NULL);
            $table->string('shipping_tel', 20);
            $table->string('shipping_name', 100);
            $table->string('pickup_date', 8)->nullable()->default(NULL);
            $table->tinyInteger('pickup_time')->nullable()->default(0);
            $table->text('comment')->nullable()->default(NULL);
            $table->dateTime('date_logistics_accept')->nullable();
            $table->string('tanto_logistics_accept', 20)->nullable()->default(NULL);
            $table->tinyInteger('flg_dl_pickup')->default(0);
            $table->dateTime('date_dl_pickup');
            $table->dateTime('date_login')->nullable();
            $table->dateTime('date_accept')->nullable();
            $table->tinyInteger('flg_dl_history')->default(0);
            $table->dateTime('date_dl_history');
            $table->smallInteger('tanto_accept_confirm')->default(0);
            $table->smallInteger('tanto_gyomu')->default(0);
            $table->smallInteger('not_accepted_method')->nullable()->default(NULL);
            $table->smallInteger('inquiry_class')->nullable()->default(NULL);
            $table->smallInteger('request_for_investigation')->nullable()->default(NULL);
            $table->smallInteger('sales_destination')->nullable()->default(NULL);
            $table->text('comment_cc')->nullable()->default(NULL);
            $table->tinyInteger('p_arrangement')->nullable()->default(NULL);
            $table->tinyInteger('flg_p_arrangement_dtime')->nullable()->default(NULL);
            $table->string('p_arrangement_pickup_date', 8)->nullable()->default(NULL);
            $table->tinyInteger('p_arrangement_pickup_time')->nullable()->default(NULL);
            $table->tinyInteger('p_arrangement_delivery_com')->nullable()->default(NULL);
            $table->string('p_arrangement_order_id', 15);
            $table->string('p_arrangement_invoice_no', 20)->nullable()->default(NULL);
            $table->tinyInteger('repay_response')->nullable()->default(NULL);
            $table->tinyInteger('invest_flg_photo')->nullable()->default(NULL);
            $table->tinyInteger('invest_flg_cc_action')->nullable()->default(NULL);
            $table->string('invest_text1', 20)->nullable()->default(NULL);
            $table->string('invest_date', 8)->nullable()->default(NULL);
            $table->tinyInteger('invest_requester')->nullable()->default(NULL);
            $table->text('invest_contents')->nullable()->default(NULL);
            $table->tinyInteger('invest_bad_acceptance')->nullable()->default(NULL);
            $table->tinyInteger('invest_product_final_place')->nullable()->default(NULL);
            $table->text('invest_result')->nullable()->default(NULL);
            $table->text('invest_last_action')->nullable()->default(NULL);
            $table->tinyInteger('gyom_size_act')->nullable()->default(NULL);
            $table->string('gyom_size_memo', 200)->nullable()->default(NULL);
            $table->string('gyom_size_voucher_date', 8)->nullable()->default(NULL);
            $table->tinyInteger('gyom_size_voucher_time')->nullable()->default(NULL);
            $table->tinyInteger('gyom_returns_act')->nullable()->default(NULL);
            $table->string('gyom_returns_memo', 200)->nullable()->default(NULL);
            $table->string('gyom_returns_voucher_date', 8)->nullable()->default(NULL);
            $table->tinyInteger('gyom_returns_voucher_time')->nullable()->default(NULL);
            $table->tinyInteger('gyom_claim_act')->nullable()->default(NULL);
            $table->string('gyom_claim_memo', 200)->nullable()->default(NULL);
            $table->string('gyom_claim_voucher_date', 8)->nullable()->default(NULL);
            $table->tinyInteger('gyom_claim_voucher_time')->nullable()->default(NULL);
            $table->tinyInteger('gyom_going_first_act')->nullable()->default(NULL);
            $table->string('gyom_going_first_memo', 200)->nullable()->default(NULL);
            $table->string('gyom_going_first_voucher_date', 8)->nullable()->default(NULL);
            $table->tinyInteger('gyom_going_first_voucher_time')->nullable()->default(NULL);
            $table->text('comment_gyom')->nullable()->default(NULL);
            $table->tinyInteger('response_request')->nullable()->default(NULL);
            $table->tinyInteger('response_requester')->nullable()->default(NULL);
            $table->tinyInteger('response_responder')->nullable()->default(NULL);
            $table->tinyInteger('action_status')->nullable()->default(NULL);
            $table->text('comment_irai');
            $table->dateTime('date_response_request');
            $table->tinyInteger('kbn_carriage_cancel')->default(0);
            $table->tinyInteger('kbn_product_select')->nullable()->default(1);
            $table->timestamp('date_added')->useCurrent();
            $table->string('t_register', 20)->nullable()->default(NULL);
            $table->timestamp('last_modified')->nullable();
            $table->string('u_register', 20)->nullable()->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_t_accept');
    }
};
