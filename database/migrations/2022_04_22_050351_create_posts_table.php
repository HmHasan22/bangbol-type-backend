<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('posts', function (Blueprint $table) {
			$table->id();
			$table->string("competition")->nullable();
			$table->string("competitionCht")->nullable();
			$table->string("competitionChs")->nullable();
			$table->string("competitionKor")->nullable();
			$table->string("competitionVie")->nullable();
			$table->string("hometeam")->nullable();
			$table->string("hometeamCht")->nullable();
			$table->string("hometeamChs")->nullable();
			$table->string("hometeamKor")->nullable();
			$table->string("hometeamVie")->nullable();
			$table->string("awayteam")->nullable();
			$table->string("awayteamCht")->nullable();
			$table->string("awayteamKor")->nullable();
			$table->string("awayteamChs")->nullable();
			$table->string("awayteamVie")->nullable();
			$table->string("date")->nullable();
			$table->string("time")->nullable();
			$table->string('title')->nullable();
			$table->string('titlelong')->nullable();
			$table->longText('section')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('posts');
	}
};
