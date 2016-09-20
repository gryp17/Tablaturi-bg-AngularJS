<?php

class Social extends Controller {

	public function __construct() {

		/**
		 * List of required parameters and permissions for each API endpoint
		 * also indicates the parameter type
		 */
		$this->endpoints = array(
			'generateOpenGraphTags' => array(
				'required_role' => self::PUBLIC_ACCESS,
				'params' => array(
					'type' => 'in[article,tab]',
					'id' => 'int'
				)
			)
		);

		#request params
		$this->params = $this->checkRequest();
	}

	public function index() {
		
	}

	/**
	 * Generates an empty html page containing only the open graph (og) meta tags needed for the social networks sharing
	 */
	public function generateOpenGraphTags() {
		$open_graph_data = array();
		
		//shared article
		if($this->params['type'] === 'article'){
			$article_model = $this->load_model('ArticleModel');
			$data = $article_model->getArticle($this->params['id']);

			if($data === null){
				$this->sendResponse(1, ErrorCodes::NOT_FOUND);
			}

			$open_graph_data['url'] = 'http://'.Config::DOMAIN.'/article/'.$this->params['id'];
			$open_graph_data['title'] = htmlentities(strip_tags($data['title']));
			$open_graph_data['description'] = htmlentities(strip_tags($data['content']));
			$open_graph_data['image'] = 'http://'.Config::DOMAIN.'/'.Config::ARTICLES_DIR.$data['picture'];
		}
		//shared tab
		else if($this->params['type'] === 'tab'){
			$tab_model = $this->load_model('TabModel');
			$data = $tab_model->getTab($this->params['id']);

			if($data === null){
				$this->sendResponse(1, ErrorCodes::NOT_FOUND);
			}

			$open_graph_data['url'] = 'http://'.Config::DOMAIN.'/tab/'.$this->params['id'];
			$open_graph_data['title'] = htmlentities(strip_tags($data['band'].' - '.$data['song']));

			//if the tab type is guitar pro - set default content (otherwise the tab text content is used)
			if($data['type'] === 'gp'){
				$data['content'] = 'Свали '.$data['band'].' - '.$data['song'].' таблатура в Guitar Pro формат';
			}

			$open_graph_data['description'] = htmlentities(strip_tags($data['content']));
			$open_graph_data['image'] = 'http://'.Config::DOMAIN.'/static/img/logo-tablaturi-bg.png';
		}
		
		$this->load_view('social/open-graph', $open_graph_data);
	}


}
