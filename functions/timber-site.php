<?php

	class TimberSite extends TimberCore {
		function __construct($site_name_or_id = null){
			$this->init($site_name_or_id);
		}

		function init($site_name_or_id){
			if ($site_name_or_id === null){
				$site_name_or_id = get_current_site();
				$site_name_or_id = $site_name_or_id->id;
			}
			$info = get_blog_details($site_name_or_id);
			$this->import($info);
			$this->ID = $info->blog_id;
			$this->name = $this->blogname;
			$theme_slug = get_blog_option($info->blog_id, 'stylesheet');
			//echo 'init '.$theme_slug;
			$this->theme = new TimberTheme($theme_slug);
			$this->description = get_blog_option($info->blog_id, 'blogdescription');
		}

		function __get($field){
			if (!isset($this->$field)){
				$this->$field = get_blog_option($this->ID, $field);
			}
			return $this->$field;
		}
	}