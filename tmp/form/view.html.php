<?php
/**
 * @version     1.0.2
 * @package     com_student
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Gala <galina.ck@gmail.com> - http://
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View class for a list of Student.
 */
class StudentViewForm extends JView
{
	public function display($tpl = null)
	{
        $app	= JFactory::getApplication();
        $model =& $this->getModel();
        //$detail1 = $model->getForm();

        $this->params = $app->getParams('com_student');

        $this->form		= $this->get('Form');

        $this->_prepareDocument();
        // Set the document
        //$this->setDocument();

        //return $detail1;
        parent::display($tpl);



	}
    protected function _prepareDocument()
    {
        $app	= JFactory::getApplication();
        $menus	= $app->getMenu();
        $title	= null;

        // Because the application sets a default page title,
        // we need to get it from the menu item itself
        $menu = $menus->getActive();
        if($menu)
        {
            $this->params->def('page_heading', $this->params->get('page_title', $menu->title));
        } else {
            $this->params->def('page_heading', JText::_('com_student_DEFAULT_PAGE_TITLE'));
        }
        $title = $this->params->get('page_title', '');
        if (empty($title)) {
            $title = $app->getCfg('sitename');
        }
        elseif ($app->getCfg('sitename_pagetitles', 0) == 1) {
            $title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
        }
        elseif ($app->getCfg('sitename_pagetitles', 0) == 2) {
            $title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
        }
        $this->document->setTitle($title);


    }

}
