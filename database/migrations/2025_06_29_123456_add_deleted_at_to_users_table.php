public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->softDeletes();
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropSoftDeletes();
    });
}
