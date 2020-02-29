<?php

namespace Zmcms\WebsiteNavigations\Frontend\Model;
use Illuminate\Support\Facades\DB;

class WebsiteNavigationJoined{
	public static function get_records($position = null){
		// return 'position: '.$position;
		$tblNamePrefix=(Config('database.prefix')??'');
		$navigations		=$tblNamePrefix.'website_navigations';
		$navigations_names		=$tblNamePrefix.'website_navigations_names';
		$navigations_content	=$tblNamePrefix.'website_navigations_content';
		return DB::table($navigations)
		->leftJoin($navigations_names, $navigations.'.token', '=', $navigations_names.'.token')
		->leftJoin($navigations_content, $navigations.'.token', '=', $navigations_content.'.token')
		->select([
			$navigations.'.token as token',
			$navigations.'.parent as parent',
			$navigations.'.position as position',
			$navigations.'.sort as sort',
			$navigations.'.access as access',
			$navigations.'.type as type',
			$navigations.'.active as active',
			$navigations.'.icon as icon',
			$navigations.'.ilustration as ilustration',
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
			$navigations_content.'.content as content',
		])
		->when(($position != null), function ($query) use ($position){
			return $query->where('position', $position);	
		})
		->get() ?? '';
	}

}
					// 'token'				=> $n->token,
					// 'parent'			=> $n->parent,
					// 'position'			=> $n->position,
					// 'sort'				=> $n->sort,
					// 'access'			=> $n->access,
					// 'type'				=> $n->type,
					// 'active'			=> $n->active,
					// 'icon'				=> $n->icon,
					// 'ilustration'		=> $n->ilustration,
					// 'date_from'			=> $n->date_from,
					// 'date_to'			=> $n->date_to,
					// 'langs_id'			=> $n->langs_id,
					// 'link'				=> $n->link,
					// 'link_override'		=> $n->link_override,
					// 'name'				=> $n->name,
					// 'slug'				=> $n->slug,
					// 'meta_keywords'		=> $n->meta_keywords,
					// 'meta_description'	=> $n->meta_description,
					// 'og_title'			=> $n->og_title,
					// 'og_type'			=> $n->og_type,
					// 'og_url'			=> $n->og_url,
					// 'og_image'			=> $n->og_image,
					// 'og_description'	=> $n->og_description,