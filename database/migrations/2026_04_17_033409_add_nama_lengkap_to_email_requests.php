use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('email_requests', function (Blueprint $table) {
            $table->string('nama_lengkap')->after('opd_id');
        });
    }

    public function down(): void
    {
        Schema::table('email_requests', function (Blueprint $table) {
            $table->dropColumn('nama_lengkap');
        });
    }
};
