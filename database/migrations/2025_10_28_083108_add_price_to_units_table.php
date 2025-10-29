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
            Schema::table('units', function (Blueprint $table) {
                // Tambahkan kolom 'price' setelah 'status'
                // Kita set default 100000 agar data lama tidak error
                $table->decimal('price', 10, 2)->default(100000)->after('status');
            });
        }
    
        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('units', function (Blueprint $table) {
                $table->dropColumn('price');
            });
        }
    };