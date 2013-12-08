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

class StudentModelRss2 extends jModelList{

    function getListQuery()
    {
        $db = JFactory::getDBO();
        $query	= $db->getQuery(true);
        /*$query = "SELECT name FROM #__student ORDER BY ";*/
        /*$query = "select * from #__student_ order by id DESC";*/

        $query->select($this->getState('item.select', 'a.*'));
        $query->from('#__student_ AS a');

        /*return $query;*/
        $db->setQuery($query);
        $db_value = $db->loadObjectList();
        $this->getShowxml($db_value);
        return $db_value;
    }


    function getShowxml($db_value){
        ob_clean();
        header("Cache-Control:no-cache, must-revalidate");
        header("Expires: Fr, 6 Dec 2013 20:00:00 GMT");
        header("content-type: text/xml");

        echo '<?xml version="1.0" encoding="utf-8"?>';

        echo '<rss  version="2.0">';
        echo '<channel>';
        echo '<title>Student List</title>';
        //echo '<link>'.JURI::root().'</link>';
            /*if (count($db_value) > 0){*/
            //echo '<br><pre>dsfsdf'; print_r($db_value);
        foreach ($db_value as $value){
            echo '<item>';
            echo '<title>';
            echo '<![CDATA['.$value->name.']]>';
            echo '</title>';
            echo '<description>';
            echo '<![CDATA['.$value->id.']]>';
            echo "<![CDATA[<br>]]>";
            echo '<![CDATA['.$value->group.']]>';
            echo '</description>';
            echo '<group>'.$value->group.'</group>';
            echo '</item>';
        }
        echo '</channel>';
        echo '</rss>';
/*}*/
exit();



}

    /*
    function getrecords(){

        $db = JFactory::getDbo();
        $query = "select * from #__student_ order by id DESC";
        $db_value = $db->loadObjectList();
        $this->showxml($db_value);
    }*/




}
