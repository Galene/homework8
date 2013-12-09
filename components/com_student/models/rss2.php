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


        $db->setQuery($query);
        $db_value = $db->loadObjectList();
        $this->getShowxml($db_value);
        return $db_value;
    }


    function getShowxml($db_value){
        ob_clean();                                         //Удаление содержимого выходного буфера
        header("Cache-Control:no-cache, must-revalidate");  //Принудительное отключение кэширования
        header("Expires: Fr, 8 Dec 2013 10:00:00 GMT");     //Дата в прошлом
        header("content-type: text/xml");
        $mainframe = JFactory::getApplication();
        $siteName = $mainframe->getCfg('sitename');

        $baseUrl = JURI::base();
        $baseUrl1 = parse_url($baseUrl);
        $baseUrl1 = $baseUrl1['scheme'] . '://' . $baseUrl1['host'];

        $current_path = "components/com_student/rss2/";

        echo '<?xml version="1.0" encoding="utf-8"?>';
        echo '<rss  version="2.0">';
        echo '<channel>';
        echo '<title>'.$siteName.'</title>';
        echo '<link>'.JURI::root().'</link>';
        if (count($db_value) > 0){
        foreach ($db_value as $value){

            $valueId = (int)$value->id;
            $photo = $baseUrl1 . JRoute::_($value->photo);
            $fbPath = $baseUrl1 . JRoute::_('index.php?option=com_student&view=academicachievement&id=' . $valueId);

            $previewimage = JURI::base() . $current_path . $value->photo;


            echo '<item>';
            echo '<title>'; echo '<![CDATA['.$value->name.']]>'; echo '</title>';
            echo '<link>'. $fbPath.'</link>';
            echo '<image>';
            echo '<url>'.$photo.'</url>';
            echo '</image>';
            echo '<description>';

            //echo '<![CDATA[<img src="http://edu.loc/'.$value->photo.'">]]>';

            //echo '<img src='".$value->photo."'/>';
            //echo '<![CDATA[<img src=".$previewimage.">]]>';
            //echo '<![CDATA[<img src=".$photo.">]]>';

            echo '<![CDATA['.$value->general_information.']]>';

            echo '</description>';
            echo '</item>';
        }
        echo '</channel>';
        echo '</rss>';
}
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
