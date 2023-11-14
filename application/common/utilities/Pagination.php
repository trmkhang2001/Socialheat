<?php

namespace app\common\utilities;

use CI_Pagination;

class Pagination
{


	public static function bootstrap($total_row, $base_url = '', $per_page = 20, $query_name = 'page', $num_links = 0){
		if (empty($base_url)){
			$base_url = current_url();
		}

		$config = array(
			'base_url'      => $base_url,
			'per_page'      => $per_page,
			'num_links'     => $num_links,
			'total_rows'    => $total_row,

			'first_url'     => '', //"?$query_name=1",
			'use_page_numbers'      => TRUE,
			'page_query_string'     => TRUE,
			'query_string_segment'  => $query_name,
			'first_link'            => 'First',
			'prev_link'             => '&laquo;',
			'next_link'             => '&raquo;',
			'last_link'             => FALSE,
			'reuse_query_string'    => TRUE

		);

		$config['cur_tag_open']     = '<li class="  page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close']    = '</a></li>';

		$config['num_tag_open']     = '<li class=" page-item">';
		$config['num_tag_close']    = '</li>';
		$config['next_tag_open']    = '<li class=" page-item">';
		$config['next_tag_close']   = '</li>';
		$config['prev_tag_open']    = '<li  class=" page-item">';
		$config['prev_tag_close']   = '</li>';
		$config['first_tag_open']   = '<li  class=" page-item">';
		$config['first_tag_close']  = '</li>';
		$config['last_tag_open']    = '<li  class=" page-item"> ';
		$config['last_tag_close']   = '</li>';
		$config['attributes'] = array('class' => 'page-link');

		$pagination = new \CI_Pagination($config);
		$page_link  = '<ul class="pagination">'.$pagination->create_links().'</ul>';
		return $page_link;

	}
}
