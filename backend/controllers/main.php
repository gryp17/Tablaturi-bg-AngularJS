<?php

class Main extends Controller {

	public function index($param1 = '', $param2 = '') {

		#$api_model = $this->load_model('API_model', true);
		#echo $api_model->getArticles();

		$this->load_view("main_view", "");
	}

}
