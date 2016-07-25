<?php

/**
 * @file plugins/generic/bookPage/BookPagePlugin.inc.php
 *
 * Copyright (c) 2016 Language Science Press
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class BookPagePlugin
 */

import('lib.pkp.classes.plugins.GenericPlugin');

class BookPagePlugin extends GenericPlugin {
	/**
	 * Register the plugin.
	 * @param $category string
	 * @param $path string
	 */
	function register($category, $path) {

		if (parent::register($category, $path)) {
			if ($this->getEnabled()) {
				HookRegistry::register ('TemplateManager::display', array(&$this, 'handleDisplayTemplate'));
			}
			return true;
		}
		return false;
	}

	function handleDisplayTemplate($hookName, $args) {

		$request = $this->getRequest();
		$templateMgr =& $args[0];
		$template =& $args[1];

		switch ($template) {
			
			case 'frontend/pages/book.tpl':
			
				// replace the template book.tpl wich includes the template monograph_full.tpl
				$templateMgr->display($this->getTemplatePath() . 'langsci_book.tpl', 'text/html', 'TemplateManager::display');
				return true;

			/*	case 'frontend/pages/index.tpl':	

				if (PluginRegistry::getPlugin('generic', 'slidercontentplugin')) {
					import('plugins.generic.sliderContent.classes.SliderContentDAO');
					$sliderContentDao = new SliderContentDao();
					$contentArray = $sliderContentDao->getAllContent($request->getPress()->getId());

					$content='';
					foreach ($contentArray as $value) {
						$content.= "<div class='slider-container'>";
						$content.= $value;
						$content.= "</div>";
					}
					$templateMgr->assign('content',$content);
				}
				

				$templateMgr->assign('title',__('plugins.generic.bookPage.title'));
				$templateMgr->assign('baseUrl',$request->getBaseUrl());

				$templateMgr->display($this->getTemplatePath() . 
					'home.tpl', 'text/html', 'TemplateManager::display');

			return true;
			*/
		}
		return false;
	}

	/**
	 * @copydoc PKPPlugin::getDisplayName()
	 */
	function getDisplayName() {
		return __('plugins.generic.bookPage.displayName');
	}

	/**
	 * @copydoc PKPPlugin::getDescription()
	 */
	function getDescription() {
		return __('plugins.generic.bookPage.description');
	}

	/**
	 * @copydoc PKPPlugin::getTemplatePath
	 */
	function getTemplatePath() {
		return parent::getTemplatePath() . 'templates/';
	}
}

?>
