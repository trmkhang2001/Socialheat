<?php
function mkdirs($dir, $mode = 0777, $recursive = TRUE)
{
	if (is_null($dir) || $dir === "")
	{
		return FALSE;
	}
	if (is_dir($dir) || $dir === "/")
	{
		return TRUE;
	}
	if (mkdirs(dirname($dir), $mode, $recursive))
	{
		return mkdir($dir, $mode);
	}
	return FALSE;
}

/**
 * Function that renders input for admin area based on passed arguments
 * @param  string $name             input name
 * @param  string $label            label name
 * @param  string $value            default value
 * @param  string $type             input type eq text,number
 * @param  array  $input_attrs      attributes on <input
 * @param  array  $form_group_attr  <div class="form-group"> html attributes
 * @param  string $form_group_class additional form group class
 * @param  string $input_class      additional class on input
 * @return string
 */
function render_input($name, $label = '', $value = '', $type = 'text', $input_attrs = [], $form_group_attr = [], $form_group_class = '', $input_class = '')
{
	$input            = '';
	$_form_group_attr = '';
	$_input_attrs     = '';
	foreach ($input_attrs as $key => $val) {
		$_input_attrs .= $key . '=' . '"' . $val . '" ';
	}

	$_input_attrs = rtrim($_input_attrs);

	$form_group_attr['app-field-wrapper'] = $name;

	foreach ($form_group_attr as $key => $val) {
		// tooltips
		$_form_group_attr .= $key . '=' . '"' . $val . '" ';
	}

	$_form_group_attr = rtrim($_form_group_attr);

	if (!empty($form_group_class)) {
		$form_group_class = ' ' . $form_group_class;
	}
	if (!empty($input_class)) {
		$input_class = ' ' . $input_class;
	}
	$input .= '<div class="form-group' . $form_group_class . '" ' . $_form_group_attr . '>';
	if ($label != '') {
		$input .= '<label for="' . $name . '" class="control-label">' . $label . '</label>';
	}
	$input .= '<input type="' . $type . '" id="' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . set_value($name, $value) . '">';
	$input .= '</div>';

	return $input;
}

function formatDate($dateStr,$format = 'Y-m-d')
{
	$date = date_create_from_format($format, $dateStr);
	if ($date && $date->format('Y') > 0)
	{
		return $date->format($format);
	}
	return '';
}

function formatDateTime($dateStr,$format = 'Y-m-d H:i:s')
{
	$date = date_create_from_format($format, $dateStr);
	if ($date && $date->format('Y') > 0)
	{
		return $date->format($format);
	}
	return '';
}

/**
 * @param $item
 * @return bool|CI_Loader|object
 */

function connectDb($item){
	$CI = &get_instance();
	try{
		$config_db = [
			'hostname' => $item->hostname,
			'username' => $item->username,
			'password' => $item->password ? $item->password : '',
			'database' => $item->database,
			'dbdriver' => 'mysqli',
			'dbprefix' => '',
			'pconnect' => FALSE,
			'db_debug' => (ENVIRONMENT !== 'production') ? FALSE : TRUE,
			'cache_on' => true,
			'cachedir' => '',
			'char_set' => 'utf8',
			'dbcollat' => 'utf8_general_ci',
			'swap_pre' => '',
			'encrypt' => FALSE,
			'compress' => FALSE,
			'stricton' => FALSE,
			'failover' => array(),
			'save_queries' => TRUE
		];
		$db_connect =  $CI->load->database($config_db,TRUE);
		if($db_connect->initialize() === TRUE){
			return  $db_connect;
		}
		return FALSE;
	}catch(\Exception $e){
		echo "<pre>";print_r($e->getMessage());die;
	}
}
function get_relationship_colors()
{
	return array(
		'engaged'                   => 'pink',
		'single'                    => 'blue',
		'divorced'                  => 'orange',
		'separated'                 => 'green',
		'widowed'                   => 'red',
		'married'                   => 'yellow',
		'other'                     => 'orange',
		'none'                      => 'green',
		'in_a_civil_union'          => 'pink',
		'in_a_domestic_partnership' => 'blue',
		'in_a_relationship'         => 'orange',
		'in_an_open_relationship'   => 'yellow',
		'it_s_complicated'          => 'red',
	);
}
function get_colors()
{
	return array(
		'#f4516c',
		'#36a3f7',
		'#007bff',
		'#6610f2',
		'#6f42c1',
		'#5867dd',
		'#ffb822',
		'#34bfa3',
	);
}

function get_uid_fields()
{
	return array(
		// 'Id',
		// 'Uid',
		'Phone'        => 'Phone',
		// 'Name' => 'Name',
		'Sex'          => 'Sex',
		'Location'     => 'Location',
		'Friends'      => 'Friends',
		'Follow'       => 'Follows',
		'Birthday'     => 'Birthday',
		'Relationship' => 'Relationship',
		'email'        => 'Email',

		// 'Phone2',
		'Fullname'     => 'Fullname',
		'Cmnd'         => 'CMND',
		'City'         => 'City',
		'Address'      => 'Address',
		'Car'          => 'Car',
		'Bank'         => 'Bank',
		'Income'       => 'Income',
		'House'        => 'House',
		'Children'     => 'Children',
		'Title'        => 'Title',
		'Company'      => 'Company',
		'Note'         => 'Note',
		// 'Type',
		// 'Note2',
		// 'Note3',
		// 'Note4',
		'Note5'        => 'Quận Huyện',
		'Note6'        => 'Thuê bao',
		// 'Note7',
	);
}

function get_fields_to_show()
{
	return array(
		'Relationship' => 'Relationship',
		'Cmnd'         => 'CMND',
		'Address'      => 'Address',
		'Company'      => 'Company',
		'Title'        => 'Title',
		'Note6'        => 'Thuebao',
	);
}


function get_fields_icons()
{
	return array(
		"Relationship" => "la-users",
		"Address"      => "la-home",
		"CMND"         => "la-credit-card",
		"cmnd"         => "la-credit-card",
		"Company"      => "la-university",
		"Title"        => "la-pencil",
		"Thuê bao"     => "la-signal",
		"Thuebao"      => "la-signal",
	);
}

function get_extra_fields_label()
{
	return array(
		'Fullname' => 'Full name',
		'Cmnd'     => 'CMND',
		'City'     => 'City',
		'Address'  => 'Address',
		'Car'      => 'Car',
		'Bank'     => 'Bank',
		'Income'   => 'Income',
		'House'    => 'House',
		'Children' => 'Children',
		'Title'    => 'Title',
		'Company'  => 'Company',
		'Note'     => 'Note',
		'Note5'    => 'Quận Huyện',
		'Note6'    => 'Thuê bao',
	);
}

function get_extra_fields()
{
	return array(
		'City',
		'Address',
		'Car',
		'Bank',
		'Income',
		'House',
		'Children',
		'Title',
		'Company',
		'Note',
		'Note5',
		'Note6',
		'Fullname',
		'Cmnd'
	);
}

function get_uid_default_check_fields()
{
	return array(
		'Id',
		'Uid',
		'Phone',
		'Name',
		'Sex',
		'Location',
		'Friends',
		'Follow',
		'Birthday',
		'Relationship',
		'email',
	);
}
function render_field_panel()
{
	$fields = get_uid_fields();
	$defaults = get_uid_default_check_fields();
	$extra = get_extra_fields();
	?>
	<style type="text/css" id="field-display-style">
		<?php foreach ($extra as $key => $value) : ?>
		#uidTable td.<?php echo $value ?>, #uidTable th.<?php echo $value ?> {
			display: none;
		}

		#myTable td.<?php echo $value ?>, #myTable th.<?php echo $value ?> {
			display: none;
		}

		<?php endforeach; ?>
	</style>
	<div class="m-form__group form-group uid-field-panel">
		<label>Select the field you want to display</label>
		<div class="m-checkbox-list">
			<?php foreach ($fields as $key => $field) : ?>
				<label class="m-checkbox m-checkbox--square">
					<input <?php if (in_array($key, $defaults)) {
						echo "checked='true'";
					} ?> type="checkbox" value="<?php echo $key; ?>"> <?php echo $field; ?>
					<span></span>
				</label>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
}

function ids_from($array, $id_field = 'id')
{
	$ids = [];
	foreach ($array as $item)
	{
		if (isset($item[$id_field]))
		{
			$ids[] = $item[$id_field];
		}
	}
	return $ids;
}

function helper_pagination($totals, $current_page)
{
	?>
	<ul class="pagination">
		<?php if ($current_page > 1): ?>
			<li class="paginate_button page-item previous disabled" id="groupTable_previous"><a href="#"
																								aria-controls="groupTable"
																								data-dt-idx="0"
																								tabindex="0"
																								class="page-link"><i
							class="la la-angle-left"></i></a></li>
		<?php endif; ?>

		<?php
		if ($totals <= 10)
		{

			for ($i = 1; $i <= $totals; $i++)
			{ ?>
				<li class="paginate_button page-item <?php if ($i == $current_page) {
					echo 'active';
				} ?>"><a href="#" aria-controls="groupTable" data-dt-idx="<?php echo $i; ?>" tabindex="0"
						 class="page-link"><?php echo $i; ?></a></li>
			<?php }

		}


		if ($totals > 10)
		{

			if ($current_page < 5)
			{
				for ($i = 1; $i <= 5; $i++)
				{ ?>
					<li class="paginate_button page-item <?php if ($i == $current_page) {
						echo 'active';
					} ?>"><a href="#" aria-controls="groupTable" data-dt-idx="<?php echo $i; ?>" tabindex="0"
							 class="page-link"><?php echo $i; ?></a></li>
				<?php }

				echo '<li class="paginate_button page-item disabled" id="groupTable_ellipsis"><a href="#" aria-controls="groupTable" data-dt-idx="6" tabindex="0" class="page-link">…</a></li>';

				for ($i = $totals - 2; $i <= $totals; $i++)
				{ ?>
					<li class="paginate_button page-item <?php if ($i == $current_page) {
						echo 'active';
					} ?>"><a href="#" aria-controls="groupTable" data-dt-idx="<?php echo $i; ?>" tabindex="0"
							 class="page-link"><?php echo $i; ?></a></li>

				<?php }

			} else
			{
				for ($i = 1; $i < 3; $i++)
				{ ?>
					<li class="paginate_button page-item <?php if ($i == $current_page) {
						echo 'active';
					} ?>"><a href="#" aria-controls="groupTable" data-dt-idx="<?php echo $i; ?>" tabindex="0"
							 class="page-link"><?php echo $i; ?></a></li>
				<?php }
				echo '<li class="paginate_button page-item disabled" id="groupTable_ellipsis"><a href="#" aria-controls="groupTable" data-dt-idx="6" tabindex="0" class="page-link">…</a></li>';
				$j = $current_page - 2;
				$k = $current_page + 2;
				if ($k > $totals || $k > $totals - 5)
				{
					$k = $totals;
					for ($i = $j; $i <= $k; $i++)
					{ ?>
						<li class="paginate_button page-item <?php if ($i == $current_page) {
							echo 'active';
						} ?>"><a href="#" aria-controls="groupTable" data-dt-idx="<?php echo $i; ?>" tabindex="0"
								 class="page-link"><?php echo $i; ?></a></li>

					<?php }
				} else
				{

					for ($i = $j; $i <= $k; $i++)
					{ ?>
						<li class="paginate_button page-item <?php if ($i == $current_page) {
							echo 'active';
						} ?>"><a href="#" aria-controls="groupTable" data-dt-idx="<?php echo $i; ?>" tabindex="0"
								 class="page-link"><?php echo $i; ?></a></li>

					<?php }
					echo '<li class="paginate_button page-item disabled" id="groupTable_ellipsis"><a href="#" aria-controls="groupTable" data-dt-idx="6" tabindex="0" class="page-link">…</a></li>';

					for ($i = $totals - 2; $i <= $totals; $i++)
					{ ?>
						<li class="paginate_button page-item <?php if ($i == $current_page) {
							echo 'active';
						} ?>"><a href="#" aria-controls="groupTable" data-dt-idx="<?php echo $i; ?>" tabindex="0"
								 class="page-link"><?php echo $i; ?></a></li>

					<?php }
				}
			}
		}


		?>

		<?php if ($current_page < $totals): ?>
			<li class="paginate_button page-item next" id="groupTable_next"><a href="#" aria-controls="groupTable"
																			   data-dt-idx="<?php echo $current_page + 1; ?>"
																			   tabindex="0" class="page-link"><i
							class="la la-angle-right"></i></a></li>
		<?php endif; ?>
	</ul>
	<?php
}

function get_cities()
{
	return array('Hà Nội', 'Hồ Chí Minh', 'An Giang', 'Bà Rịa - Vũng Tàu', 'Bắc Giang', 'Bắc Kạn', 'Bạc Liêu', 'Bắc Ninh', 'Bến Tre', 'Bình Định', 'Bình Dương', 'Bình Phước', 'Bình Thuận', 'Cà Mau', 'Cao Bằng', 'Đắk Lắk', 'Đắk Nông', 'Điện Biên', 'Đồng Nai', 'Đồng Tháp', 'Gia Lai', 'Hà Giang  ', 'Hà Nam', 'Hà Tĩnh', 'Hải Dương', 'Hậu Giang', 'Hòa Bình', 'Hưng Yên', 'Khánh Hòa', 'Kiên Giang', 'Kon Tum', 'Lai Châu', 'Lâm Đồng', 'Lạng Sơn', 'Lào Cai', 'Long An', 'Nam Định', 'Nghệ An', 'Ninh Bình', 'Ninh Thuận', 'Phú Thọ', 'Quảng Bình  ', 'Quảng Nam', 'Quảng Ngãi', 'Quảng Ninh', 'Quảng Trị', 'Sóc Trăng', 'Sơn La', 'Tây Ninh', 'Thái Bình', 'Thái Nguyên', 'Thanh Hóa', 'Thừa Thiên Huế', 'Tiền Giang', 'Trà Vinh', 'Tuyên Quang', 'Vĩnh Long', 'Vĩnh Phúc', 'Yên Bái', 'Phú Yên ', 'Cần Thơ', 'Đà Nẵng', 'Hải Phòng'
	);
}


function vn_to_str($str)
{

	$unicode = array(

		'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

		'd' => 'đ',

		'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

		'i' => 'í|ì|ỉ|ĩ|ị',

		'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

		'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

		'y' => 'ý|ỳ|ỷ|ỹ|ỵ',

		'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

		'D' => 'Đ',

		'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

		'I' => 'Í|Ì|Ỉ|Ĩ|Ị',

		'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

		'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

		'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

	);

	foreach ($unicode as $nonUnicode => $uni)
	{

		$str = preg_replace("/($uni)/i", $nonUnicode, $str);

	}
	$str = str_replace(' ', '', $str);
	return $str;

}



function get_age_ranges()
{
	return array(
		'13' => array(date('Y-01-01', strtotime('-13 years')), date('Y-01-01', strtotime('-15 years')), '13 - 15', '#f4516c'),
		'16' => array(date('Y-01-01', strtotime('-16 years')), date('Y-01-01', strtotime('-17 years')), '16 - 17', '#36a3f7'),
		'18' => array(date('Y-01-01', strtotime('-18 years')), date('Y-01-01', strtotime('-24 years')), '18 - 24', '#007bff'),
		'25' => array(date('Y-01-01', strtotime('-25 years')), date('Y-01-01', strtotime('-34 years')), '25 - 34', '#6610f2'),
		'35' => array(date('Y-01-01', strtotime('-35 years')), date('Y-01-01', strtotime('-44 years')), '35 - 44', '#6f42c1'),
		'45' => array(date('Y-01-01', strtotime('-45 years')), date('Y-01-01', strtotime('-54 years')), '45 - 54', '#5867dd'),
		'55' => array(date('Y-01-01', strtotime('-55 years')), date('Y-01-01', strtotime('-64 years')), '55 - 64', '#ffb822'),
		'65' => array(date('Y-01-01', strtotime('-65 years')), date('Y-01-01', strtotime('-150 years')), '65 - 0', '#34bfa3'),
	);
}


function trans_begin($test_mode = FALSE)
{
	$CI = &get_instance();
	//$CI->db->trans_off();
	$CI->db->trans_begin($test_mode);
}

/**
 * @param bool $throw_exception
 * @return bool
 * @throws Exception
 */
function trans_end($throw_exception = TRUE)
{
	$CI = &get_instance();
	if ($CI->db->trans_status() === FALSE)
	{
		$errors = $CI->db->error();
//		$last_query = $CI->db->last_query();
		if ($throw_exception && isset($errors['code']))
		{
			throw new Exception($errors['message'], $errors['code']);
		}
		$CI->db->trans_rollback();
		return FALSE;
	}

	$CI->db->trans_commit();
	return TRUE;
}

function trans_rollback()
{
	$CI = &get_instance();
	$CI->db->trans_rollback();
	return FALSE;
}

// ko support nên xài cái cũ search like
// SELECT  keywords FROM items WHERE MATCH(keywords) AGAINST('biệt thự biển,Wyndham,BTC,DOT' IN BOOLEAN MODE)
function getSimpleSearchCondition($field = 'name',$keywords = ''){
	if(empty($keywords)){
		$CI = &get_instance();
		$keywords = $CI->input->get('keyword', TRUE);
	}
	if(is_string($keywords)){
		$keywords = explode(',',$keywords);
	}
	$conditions = [];
	if($keywords){
		foreach ($keywords as $keyword)
		{
			$keyword = \app\common\utilities\Common::trim($keyword,TRUE);
			if($keyword){
				$conditions[0][] = array( 'CONVERT('.$field.' USING utf8) like ' =>  '%'.$keyword.'%');
			}
		}
	}
	return $conditions;
}

