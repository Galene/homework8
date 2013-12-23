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
        $this->params = $app->getParams('com_student');
        $this->form		= $this->get('Form');

        parent::display($tpl);

	}

}
