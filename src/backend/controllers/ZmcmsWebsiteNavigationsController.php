<?php
namespace Zmcms\WebsiteNavigations\Backend\Controllers;
use Illuminate\Http\Request;
use Session;
use \Zmcms\WebsiteNavigations\Backend\Db\Queries as Q;
class ZmcmsWebsiteNavigationsController extends \App\Http\Controllers\Controller
{
	private $txt =  "<?php\n"
			.'/**'."\n"
			.'* Ten plik został utworzony automatycznie.'."\n"
			.'* Jeżeli wiesz, co robisz, możesz edytować samodzielnie ten plik, '."\n"
			.'* jednak zalecamy mocno użycie formularza do aktualizacji tych danych w systemie'."\n"
			.'* Odpowiednie opcje znajdziesz w sekcji "Nawigacja"'."\n"
			.'**/'."\n";
	
	public function zmcms_website_navigations_positions(){
		$data = Q::navigation_positions_list($paginate = Session('row_count'), $order=[], $filter=[]);
		return view('themes.'.Config('zmcms.frontend.theme_name').'.backend.zmcms_website_navigations_positions', compact('data'));
		return $resultset;
	}
	public function zmcms_website_navigation_position_delete($position){
		return Q::zmcms_website_navigation_position_delete($position);
	}
	/**
	 * FORMULARZ DO TWORZENIA NOWEJ POZYCJI NAWIGACJI
	 */
	public function zmcms_website_navigation_position_new_frm(){
		$data = [];
		$settings=[
			'action' => 'create',
			'btnsave' => 'Zapisz zmiany',
		];
		return view('themes.'.Config('zmcms.frontend.theme_name').'.backend.zmcms_website_navigation_position_new_frm', compact('data', 'settings'));
		return json_encode($resultset['content']);
	}
	/**	
	 * WYWOŁANIE ZAPISU DO BAZY DANYCH NOWEJ POZYCJI NAWIGACJI
	 * LUB AKTUALIZACJI ISTNIEJĄCEJ
	 **/
	public function zmcms_website_navigation_position_save(Request $request){
		return json_encode(Q::zmcms_website_navigation_position_save($request->all()));
	}

	public function zmcms_website_navigation_positions_refresh(Request $request){
		$data = Q::navigation_positions_list($paginate = Session('row_count'), $order=[], $filter=[]);
		return view('themes.'.Config('zmcms.frontend.theme_name').'.backend.zmcms_website_navigations_positions_ajax_content', compact('data'));
	}
	/**
	 * OTWIERA FORMULARZ DO EDYCJI POZYCJI NAWIGACJI
	 */
	public function zmcms_website_navigation_position_edit_frm($position){
		$data = Q::navigation_positions_list($paginate = Session('row_count'), $order=[], $filter=[[(Config('database.prefix')??'').'website_navigations_positions.position', '=' ,$position]]);
		// return json_encode($data);
		$settings=[
			'action' => 'update',
			'btnsave' => 'Zapisz zmiany',
		];
		return view('themes.'.Config('zmcms.frontend.theme_name').'.backend.zmcms_website_navigation_position_new_frm', compact('data', 'settings'));
	}

	/**
	 * OTWIERA FORMULARZ DO ZARZĄDZANIA RODZAJAMI NAWIGACJI
	 */

	public function zmcms_website_navigations_types(){
		$data = Config(Config('zmcms.frontend.theme_name').'.website_navigations');
		return view('themes.'.Config('zmcms.frontend.theme_name').'.backend.zmcms_website_navigations_types_frm', compact('data'));
		return 'types';
	}
	/**
	 * OTWIERA FORMULARZ DO DODAWANIA NOWEGO TYPU NAWIGACJI
	 */
	public function zmcms_website_navigation_type_new_frm(){
		$data=[];
		$settings=[
			'action' => 'create',
			'btnsave' => 'Dodaj rodzaj',
		];
		return view('themes.'.Config('zmcms.frontend.theme_name').'.backend.zmcms_website_navigation_type_new_frm', compact('data', 'settings'));
	}
	/**
	 * ZAPIS 
	 */
	public function zmcms_website_navigation_type_save(Request $request){

		$data=$request->all();
		if($data['action']=='update') return $this->zmcms_website_navigation_type_update($request);
		$config_data = Config(Config('zmcms.frontend.theme_name').'.website_navigations');
		$d=DIRECTORY_SEPARATOR;
		$config_path = base_path().$d.'config'.$d.Config('zmcms.frontend.theme_name').$d.'website_navigations.php';
		if(isset($config_data[$data['type']])) return json_encode([
				'result'	=>	'error',
				'code'		=>	'website_navigation_config',
				'msg' 		=>	___("Klucz istnieje. Aby zmodyfikować istniejący rodzaj nawigacji,wybierz go do edycji"),
			]);
		$config_data[$data['type']]=[
			'run'		=> $data['run'],
			'name'			=> $data['name'],
			'description'	=> $data['description'],
		];
		$txt =$this->txt;
		$txt .= "\nreturn ". var_export($config_data, true) .";";
		$myfile = fopen($config_path, "w");
		fwrite($myfile, $txt);
		fclose($myfile);
		return json_encode([
				'result'	=>	'ok',
				'code'		=>	'ok',
				'msg' 		=>	___("Dodano nowy rodzaj nawigacji"),
			]);
	}

	public function zmcms_website_navigation_type_update(Request $request){

		$data=$request->all();
		$config_data = Config(Config('zmcms.frontend.theme_name').'.website_navigations');
		$d=DIRECTORY_SEPARATOR;
		$config_path = base_path().$d.'config'.$d.Config('zmcms.frontend.theme_name').$d.'website_navigations.php';
		unset($config_data[$data['type_old']]);
		$config_data[$data['type']]=[
			'run'		=> $data['run'],
			'name'			=> $data['name'],
			'description'	=> $data['description'],
		];
		uasort($config_data, function ($a, $b){return $a['name']<=>$b['name'];});
		$txt =$this->txt;
		$txt .= "\nreturn ". var_export($config_data, true) .";";
		$myfile = fopen($config_path, "w");
		fwrite($myfile, $txt);
		fclose($myfile);
		return json_encode([
				'result'	=>	'ok',
				'code'		=>	'ok',
				'msg' 		=>	___("Zaktualizowano nawigację"),
			]);
	}

	/**
	 * USUNIĘCIE RODZAJU NAWIGACJI Z PLIKU KONFIGURACYJNEGO 
	 */	
	
	public function zmcms_website_navigation_type_delete($type){
		$config_data = Config(Config('zmcms.frontend.theme_name').'.website_navigations');
		$d=DIRECTORY_SEPARATOR;
		$config_path = base_path().$d.'config'.$d.Config('zmcms.frontend.theme_name').$d.'website_navigations.php';
		unset($config_data[$type]);
		$txt =$this->txt;
		$txt .= "\nreturn ". var_export($config_data, true) .";";
		$myfile = fopen($config_path, "w");
		fwrite($myfile, $txt);
		fclose($myfile);
		return json_encode([
			'result'	=>	'ok',
			'code'		=>	'ok',
			'msg' 		=>	___("Usunięto rodzaj wybrany nawigacji"),
		]);
		// return json_encode();
	}
	public function zmcms_website_navigation_type_update_frm($type){
		$config_data = Config(Config('zmcms.frontend.theme_name').'.website_navigations');
		$data = $config_data[$type];
		$data['type']=$type;
		$settings=[
			'action' => 'update',
			'btnsave' => 'Aktualizuj rodzaj',
		];
		return view('themes.'.Config('zmcms.frontend.theme_name').'.backend.zmcms_website_navigation_type_new_frm', compact('data', 'settings'));
	}
}
