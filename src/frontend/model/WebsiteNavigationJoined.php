<?php

namespace Zmcms\WebsiteNavigations\Frontend\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades;

class WebsiteNavigationJoined extends Model{
	/**
	 * $sort=[['sort', 'asc']]
	 */
	public static function get_records($position = null, $active_only = true, $sort = null, $q = null, $langs_id = null){
		// return 'position: '.$position;
		$tblNamePrefix=(Config('database.prefix')??'');
		$navigations		=$tblNamePrefix.'website_navigations';
		$navigations_names		=$tblNamePrefix.'website_navigations_names';
		$navigations_content	=$tblNamePrefix.'website_navigations_content';
		// return 'aa';
		$result =  DB::table($navigations)
		->leftJoin($navigations_names, $navigations.'.token', '=', $navigations_names.'.token')
		->leftJoin($navigations_content, $navigations.'.token', '=', $navigations_content.'.token')
		->select(
			$navigations.'.token as token',
			$navigations.'.parent as parent',
			$navigations.'.position as position',
			$navigations.'.sort as sort',
			$navigations.'.access as access',
			$navigations.'.type as type',
			$navigations.'.active as active',
			$navigations.'.icon as icon',
			$navigations.'.ilustration as ilustration',
			$navigations.'.images_resized as images_resized',
			$navigations.'.date_from as date_from',
			$navigations.'.date_to as date_to',
			$navigations_names.'.langs_id as langs_id',
			$navigations_names.'.link as link',
			$navigations_names.'.link_override as link_override',
			$navigations_names.'.name as name',
			$navigations_names.'.slug as slug',
			$navigations_names.'.meta_keywords as meta_keywords',
			$navigations_names.'.meta_description as meta_description',
			$navigations_names.'.og_title as og_title',
			$navigations_names.'.og_type as og_type',
			$navigations_names.'.og_url as og_url',
			$navigations_names.'.og_image as og_image',
			$navigations_names.'.og_description as og_description',
			$navigations_content.'.content as content'
		)
		->when(($position != null), function ($query) use ($position){
			return $query->where('position', $position);	
		})
		->when(($active_only), function ($query){
			return $query->where('active', '1');		
		})
		->when(($sort != null), function ($query) use ($sort){
			foreach ($sort as $s) {
				$query->orderBy($s[0], $s[1]);	
			}
			return $query;
		})
		->when(($langs_id != null), function ($query){
			return $query->where('langs_id', $langs_id);
		})
		->when(($q != null), function ($query) use ($q){
			return $query->limit($q);	
		})

		->get() ?? '';
		return $result;
	}
	/**
	 * Pobiera dane rodzica nawigacji o wskazanym tokenie.
	 * Jeżeli nie ma rodziac, zwracana jest wartość null.
	 */
	public static function get_parent_link($token, $langs_id = null){
		$tblNamePrefix=(Config('database.prefix')??'');
		$navigations		=$tblNamePrefix.'website_navigations';
		$navigations_names		=$tblNamePrefix.'website_navigations_names';
		$navigations_content	=$tblNamePrefix.'website_navigations_content';
		$parent = DB::table($navigations)->where('token', $token)->first();
		if($parent == null) return null;
		// return print_r($parent ,true);
		$result =  DB::table($navigations)
		->leftJoin($navigations_names, $navigations.'.token', '=', $navigations_names.'.token')
		->leftJoin($navigations_content, $navigations.'.token', '=', $navigations_content.'.token')
		->select(
			$navigations.'.token as token',
			$navigations.'.parent as parent',
			$navigations.'.position as position',
			$navigations.'.sort as sort',
			$navigations.'.access as access',
			$navigations.'.type as type',
			$navigations.'.active as active',
			$navigations.'.icon as icon',
			$navigations.'.ilustration as ilustration',
			$navigations.'.images_resized as images_resized',
			$navigations.'.date_from as date_from',
			$navigations.'.date_to as date_to',
			$navigations_names.'.langs_id as langs_id',
			$navigations_names.'.link as link',
			$navigations_names.'.link_override as link_override',
			$navigations_names.'.name as name',
			$navigations_names.'.slug as slug',
			$navigations_names.'.meta_keywords as meta_keywords',
			$navigations_names.'.meta_description as meta_description',
			$navigations_names.'.og_title as og_title',
			$navigations_names.'.og_type as og_type',
			$navigations_names.'.og_url as og_url',
			$navigations_names.'.og_image as og_image',
			$navigations_names.'.og_description as og_description',
			$navigations_content.'.content as content'
		)
		->when(($langs_id != null), function ($query) use($navigations_names){
			return $query->where($navigations_names.'.langs_id', $langs_id);
		})
		->where($navigations.'.token', $parent->parent)
		->first() ?? [];
		if ($result!=null)
			return $result->link;
		return null;

	}

	public static function get_link($token, $langs_id = null){
		$tblNamePrefix=(Config('database.prefix')??'');
		$navigations		=$tblNamePrefix.'website_navigations';
		$navigations_names		=$tblNamePrefix.'website_navigations_names';
		$navigations_content	=$tblNamePrefix.'website_navigations_content';
		return $result =  DB::table($navigations)
		->leftJoin($navigations_names, $navigations.'.token', '=', $navigations_names.'.token')
		->leftJoin($navigations_content, $navigations.'.token', '=', $navigations_content.'.token')
		->select(
			$navigations.'.token as token',
			$navigations.'.parent as parent',
			$navigations.'.position as position',
			$navigations.'.sort as sort',
			$navigations.'.access as access',
			$navigations.'.type as type',
			$navigations.'.active as active',
			$navigations.'.icon as icon',
			$navigations.'.ilustration as ilustration',
			$navigations.'.images_resized as images_resized',
			$navigations.'.date_from as date_from',
			$navigations.'.date_to as date_to',
			$navigations_names.'.langs_id as langs_id',
			$navigations_names.'.link as link',
			$navigations_names.'.link_override as link_override',
			$navigations_names.'.name as name',
			$navigations_names.'.slug as slug',
			$navigations_names.'.meta_keywords as meta_keywords',
			$navigations_names.'.meta_description as meta_description',
			$navigations_names.'.og_title as og_title',
			$navigations_names.'.og_type as og_type',
			$navigations_names.'.og_url as og_url',
			$navigations_names.'.og_image as og_image',
			$navigations_names.'.og_description as og_description',
			$navigations_content.'.content as content'
		)
		->when(($langs_id != null), function ($query) use($navigations_names){
			return $query->where($navigations_names.'.langs_id', $langs_id);
		})
		->where($navigations.'.token', $token)
		->first()->link ?? 'ee';
	}
	/**
	 * POBIERA NAWIGACJĘ PO TOKENIE
	*/
	public static function get_navigation($token, $langs_id = null){
		$tblNamePrefix=(Config('database.prefix')??'');
		$navigations		=$tblNamePrefix.'website_navigations';
		$navigations_names		=$tblNamePrefix.'website_navigations_names';
		$navigations_content	=$tblNamePrefix.'website_navigations_content';
		return $result =  DB::table($navigations)
		->leftJoin($navigations_names, $navigations.'.token', '=', $navigations_names.'.token')
		->leftJoin($navigations_content, $navigations.'.token', '=', $navigations_content.'.token')
		->select(
			$navigations.'.token as token',
			$navigations.'.parent as parent',
			$navigations.'.position as position',
			$navigations.'.sort as sort',
			$navigations.'.access as access',
			$navigations.'.type as type',
			$navigations.'.active as active',
			$navigations.'.icon as icon',
			$navigations.'.ilustration as ilustration',
			$navigations.'.images_resized as images_resized',
			$navigations.'.date_from as date_from',
			$navigations.'.date_to as date_to',
			$navigations_names.'.langs_id as langs_id',
			$navigations_names.'.link as link',
			$navigations_names.'.link_override as link_override',
			$navigations_names.'.name as name',
			$navigations_names.'.slug as slug',
			$navigations_names.'.meta_keywords as meta_keywords',
			$navigations_names.'.meta_description as meta_description',
			$navigations_names.'.og_title as og_title',
			$navigations_names.'.og_type as og_type',
			$navigations_names.'.og_url as og_url',
			$navigations_names.'.og_image as og_image',
			$navigations_names.'.og_description as og_description',
			$navigations_content.'.content as content'
		)
		->when(($langs_id != null), function ($query) use($navigations_names){
			return $query->where($navigations_names.'.langs_id', $langs_id);
		})
		->where($navigations.'.token', $token)
		->first();
	}

}