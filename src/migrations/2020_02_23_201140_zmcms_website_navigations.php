<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ZmcmsWebsiteNavigations extends Migration{
	public function up(){
		$tblNamePrefix=(Config('database.prefix')??'');

		$tblName=$tblNamePrefix.'website_navigations_positions';
		Schema::create($tblName, function($table){$table->string('position', 20);});// kod pozycji, pod którą wyświetlana jest dana nawigacja
		Schema::table($tblName, function($table){$table->integer('sort', false, true)->nullable();});	//	Sortowanie kolejności wyświetlania pozycji nawigacji w systemie CMS
		Schema::table($tblName, function($table){$table->primary('position');});

		$tblName=$tblNamePrefix.'website_navigations_positions_names';
		Schema::create($tblName, function($table){$table->string('position', 20);}); // kod pozycji, pod którą wyświetlana jest dana nawigacja
		Schema::table($tblName, function($table){$table->string('langs_id', 5);});// kod języka, np. pl, en itp
		Schema::table($tblName, function($table){$table->string('name', 20);}); // Nazwa pozycji, pod którą wyświetlana jest dana nawigacja
		Schema::table($tblName, function($table){$table->primary(['position', 'langs_id'], 'zmcmswnpnkey');});
		Schema::table($tblName, function($table) use ($tblNamePrefix){$table->foreign('position')->references('position')->on($tblNamePrefix.'website_navigations_positions')->onUpdate('cascade')->onDelete('cascade');});

		$tblName=$tblNamePrefix.'website_navigations';
		Schema::create($tblName, function($table){$table->string('token', 70);});
		Schema::table($tblName, function($table){$table->string('parent', 70)->nullable();});
		Schema::table($tblName, function($table){$table->string('position', 20);});
		Schema::table($tblName, function($table){$table->integer('sort', false, true)->nullable();});	//	Sortowanie kolejności wyświetlania nawigacji
		Schema::table($tblName, function($table){$table->string('access', 70);}); // Info, które grupy użytkowników mają dostęp do danej pozycji nawigacji. "*" -> wszyscy mają dostęp, "{'a', 'b', 'd'}" ->grupy a, b oraz d mają dostęp do artykułu
		Schema::table($tblName, function($table){$table->string('type', 25);});//np. self.single lub articles.list lub products.single etd. Zgodnie z plikiem /vendor/zmcms/config/frontend.php uruchamiany jest odpowiedni kontroler
		Schema::table($tblName, function($table){$table->string('active', 1);}); //Aktywny - 1, Nieaktywny -0. Aktywny się wyświetla, nieaktywny nie.
		Schema::table($tblName, function($table){$table->string('icon', 150)->nullable();});// Nazwa (Wyświetla się jako nazwa linku <a>Nazwa linku</a>)
		Schema::table($tblName, function($table){$table->string('ilustration', 150)->nullable();});// Ilustracja kategorii
		Schema::table($tblName, function($table){$table->string('date_from', 10)->nullable();}); // data od kiedy wyświetla się dana pozycja w nawigacji,
		Schema::table($tblName, function($table){$table->string('date_to', 10)->nullable();}); // data do kiedy wyświetla się dana pozycja w nawigacji, (null - wyświetla się zawsze, chyba, że active jest "0")
		Schema::table($tblName, function($table){$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));});//Imię
		Schema::table($tblName, function($table){$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));});//Imię
		Schema::table($tblName, function($table){$table->primary('token', 'zmcmswnkey');});
		Schema::table($tblName, function($table) use ($tblNamePrefix){$table->foreign('position')->references('position')->on($tblNamePrefix.'website_navigations_positions')->onUpdate('cascade')->onDelete('no action');});
		
		$tblName=$tblNamePrefix.'website_navigations_names';
		Schema::create($tblName, function($table){$table->string('token', 70);});
		Schema::table($tblName, function($table){$table->string('langs_id', 5);});// kod języka, np. pl, en itp
		Schema::table($tblName, function($table){$table->string('link', 150);});// link, np. o-nas, oferta/serwery, https://onet.pl, relacja do "website_navigations"
		Schema::table($tblName, function($table){$table->string('link_override', 150)->nullable();});// link, np. o-nas, oferta/serwery, https://onet.pl, relacja do "website_navigations"
		Schema::table($tblName, function($table){$table->string('name', 50);});// Nazwa (Wyświetla się jako nazwa linku <a>Nazwa linku</a>)
		Schema::table($tblName, function($table){$table->string('slug', 50);});// Nazwa (Wyświetla się jako nazwa linku <a>Nazwa linku</a>)
		Schema::table($tblName, function($table){$table->string('meta_keywords', 150)->nullable();});// Nazwa (Wyświetla się jako nazwa linku <a>Nazwa linku</a>)
		Schema::table($tblName, function($table){$table->string('meta_description', 150)->nullable();});// Nazwa (Wyświetla się jako nazwa linku <a>Nazwa linku</a>)
		Schema::table($tblName, function($table){$table->string('og_title', 150)->nullable();});// Nazwa (Wyświetla się jako nazwa linku <a>Nazwa linku</a>)
		Schema::table($tblName, function($table){$table->string('og_type', 150)->nullable();});// Nazwa (Wyświetla się jako nazwa linku <a>Nazwa linku</a>)
		Schema::table($tblName, function($table){$table->string('og_url', 150)->nullable();});// Nazwa (Wyświetla się jako nazwa linku <a>Nazwa linku</a>)
		Schema::table($tblName, function($table){$table->string('og_image', 150)->nullable();});// Nazwa (Wyświetla się jako nazwa linku <a>Nazwa linku</a>)
		Schema::table($tblName, function($table){$table->string('og_description', 150)->nullable();});// Nazwa (Wyświetla się jako nazwa linku <a>Nazwa linku</a>)
		Schema::table($tblName, function($table){$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));});//Imię
		Schema::table($tblName, function($table){$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));});//Imię
		Schema::table($tblName, function($table){$table->primary(['token', 'langs_id'], 'zmcmswnnkey');});
		Schema::table($tblName, function($table) use ($tblNamePrefix){$table->foreign('token')->references('token')->on($tblNamePrefix.'website_navigations')->onUpdate('cascade')->onDelete('cascade');});

		$tblName=$tblNamePrefix.'website_navigations_content';
		Schema::create($tblName, function($table){$table->string('token', 70);});
		Schema::table($tblName, function($table){$table->string('langs_id', 5);});// kod języka, np. pl, en itp
		Schema::table($tblName, function($table){$table->text('content');});// Jeżeli pod linkiem jest jakaś prosta treść, typu krótki artykuł, można go wpisać od razu tuta, w celu ograniczenia zapytań do bazy.
		Schema::table($tblName, function($table){$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));});//Imię
		Schema::table($tblName, function($table){$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));});//Imię
		Schema::table($tblName, function($table){$table->primary(['token', 'langs_id'], 'zmcmswnckey');});
		Schema::table($tblName, function($table) use ($tblNamePrefix){$table->foreign('token')->references('token')->on($tblNamePrefix.'website_navigations')->onUpdate('cascade')->onDelete('cascade');});

		$tblName=$tblNamePrefix.'website_navigations_relations';
		Schema::create($tblName, function($table){$table->string('token', 70);});
		Schema::table($tblName, function($table){$table->string('parent', 70);});
		Schema::table($tblName, function($table){$table->primary(['token', 'parent'], 'zmcmswnrkey');});
		Schema::table($tblName, function($table) use ($tblNamePrefix){$table->foreign('token')->references('token')->on($tblNamePrefix.'website_navigations')->onUpdate('cascade')->onDelete('cascade');});
		Schema::table($tblName, function($table) use ($tblNamePrefix){$table->foreign('parent')->references('token')->on($tblNamePrefix.'website_navigations')->onUpdate('cascade')->onDelete('cascade');});

	}
	public function down(){
	}
}
