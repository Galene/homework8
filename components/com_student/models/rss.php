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

jimport('joomla.application.component.modellist');

class StudentModelRss extends jModelList{

    function getListQuery()
    {
        $db = JFactory::getDBO();
        $query	= $db->getQuery(true);
        /*$query = "SELECT name FROM #__student ORDER BY ";*/
        /*$query = "select * from #__student_ order by id DESC";*/


        $query->select($this->getState('item.select', 'a.*'));
        $query->from('#__student AS a');

        $query->select('u.name AS author');
        $query->join('LEFT', '#__users AS u on u.id = a.created_by');

        /*return $query;*/
        $db->setQuery($query);
        $db_value = $db->loadObjectList();
        $this->display($db_value);

    }


    /*function showxml($db_value){


    }*/

    /*
    function getrecords(){

        $db = JFactory::getDbo();
        $query = "select * from #__student_ order by id DESC";
        $db_value = $db->loadObjectList();
        $this->showxml($db_value);
    }*/




}
