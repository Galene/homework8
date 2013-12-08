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
class StudentViewRss2 extends JView
{
	public function display($cachable = false, $urlparams = false)
	{
        echo "2";
        /*$model = $this->get('ListQuery');
        print_r($model);*/
        $model =& $this->getModel();
        $detail1 = $model->getListQuery();
//echo '<pre>'; print_r($detail);
        return $detail1;
	}
    	
}
