<?php
function fetch_menu($data)
{
	$show = '';
	$active = '';

	$ci = &get_instance();
	$menu1 = "";

	$color = array('text-warning', 'text-danger', 'text-success', 'text-info', 'text-muted', 'primary');
	foreach ($data as $menu) {
		$menu_active = $ci->session->userdata('menu_active');
		$sub_menu_active = $ci->session->userdata('sub_menu_active');

		// echo $menu_active.' | '.$menu_slug;die;

		if ($menu_active != '') {
			if ($menu_active == $menu->slug) {
				$active = 'active';
			} else {
				$active = '';
			}
		}

		if ($sub_menu_active != '') {
			if ($menu_active == $menu->slug) {
				$show = 'show';
			} else {
				$show = '';
			}
		}

		$menu1 .= '<li class="nav-item">';

		if (!empty($menu->sub)) {

			$menu1 .= '<a class="nav-link ' . $active . '" data-toggle="collapse" aria-expanded="false" href="#' . $menu->slug . '">
						<i class="' . $menu->icon . '"></i>
						<span class="nav-link-text">' . $menu->name . '</span>
					</a>';
			$menu1 .= '<div class="collapse ' . $show . '" id="' . $menu->slug . '">
						<ul class="nav nav-sm flex-column">';

			$menu1 .= fetch_sub_menu($menu->sub);

			$menu1 .= '</ul></div>';
		} else {
			$menu1 .= '<a class="nav-link ' . $active . '" href="' . site_url($menu->slug) . '">
						<i class="' . $menu->icon . ' ' . $color[array_rand($color)] . '"></i>
						<span class="nav-link-text">' . $menu->name . '</span>
					</a>';
		}

		$menu1 .= '</li>';
	}
	return $menu1;
}

function fetch_sub_menu($sub_menu)
{
	$sub = "";
	$active = '';
	$ci = &get_instance();
	$sub_menu_active = $ci->session->userdata('sub_menu_active');

	foreach ($sub_menu as $menu) {

		if ($sub_menu_active == $menu->slug) {
			$active = 'active';
		} else {
			$active = '';
		}

		$sub .= '<li class="nav-item ">';
		$sub .=  '<a href="' . site_url($menu->slug) . '" class="nav-link ' . $active . '">' . $menu->name . '</a>';
		$sub .= '</li>';
	}

	return $sub;
}

/* End of file menus_helper.php and path \application\helpers\menus_helper.php */
