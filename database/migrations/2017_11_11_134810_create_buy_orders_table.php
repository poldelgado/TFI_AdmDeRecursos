    <?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateBuyOrdersTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {

            Schema::create('buy_orders', function (Blueprint $table) {
                $table->increments('id');
                $table->date('date_order');
                $table->double('total');
                $table->integer('buy_qualification_id')->unsigned()->nullable();
                $table->integer('product_id')->unsigned();
                $table->integer('provider_id')->unsigned();
                $table->mediumInteger('warranty_void')->unsigned()->nullable();
                $table->timestamps();
                $table->foreign('buy_qualification_id')->references('id')->on('buy_qualifications')->onDelete('cascade');
                $table->foreign('product_id')->references('id')->on('products');
                $table->foreign('provider_id')->references('id')->on('providers');
            });

        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('buy_orders');
        }
    }
