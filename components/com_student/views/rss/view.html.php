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
class StudentViewRss extends JView
{
	public function display($detail)
	{
        $model =& $this->getModel();
        $detail = $model->getListQuery();
        /*ob_clean();
header("Cache-Control:no-cache, must-revalidate");
header("content-type: text/xml");*/

        echo '<?xml version="1.0" encoding="utf-8"?>';
        echo '<link>'.JURI::root().'</link>';
        echo '<rss  version="2.0">';

        /*if (count($db_value) > 0){*/
        foreach ($detail as $value){

            echo 'text3';
            echo '<item>';

            echo '<id>'.$value->id.'</id>';
            echo '<name>'.$value->name.'</name>';

            echo '</item>';
        }
        /*}*/

        echo '</rss>';
        exit();


        /*$listQuery = $this->get('ListQuery');
        print_r($listQuery);*/
        /*$model =& $this->getModel();
        $detail = $model->getListQuery();*/

	}
    	
}
