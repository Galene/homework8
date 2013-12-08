<?php
/**
 * @version 1.0.0
 * @package com_studentslist
 * @copyright © 2013. Все права защищены.
 * @license GNU General Public License версии 2 или более поздней; Смотрите LICENSE.txt
 * @author Marina <marinka.derkach@gmail.com> - http://
 */

// No direct access
defined('_JEXEC') or die;
//$document =& JFactory::getDocument();
//$document->addStyleSheet('components/com_studentslist/css/styles.css');
jimport('joomla.application.component.view');

/**
 * View class for a list of Studentslist.
 */
class StudentslistViewRss extends JView
{
    protected $items;

    /**
     * Display the view
     */
    public function display($tpl = null)
    {
        $app = JFactory::getApplication();
        $document =& JFactory::getDocument();


        $this->items                = $this->get('Items');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 2000 05:00:00 GMT");
        header("content-type: text/xml");

        echo '<?xml version=”1.0″ encoding=”utf-8″?>';
        echo '<rss xmlns:content=”http://purl.org/rss/1.0/modules/content/” version=”2.0″>';
        echo '<title>RSS Students</title>';
        echo '<link>'.JURI::root().'</link>';
        foreach($this->items as $value)
        {
            echo '<item>';
            echo '<name>'.$value->name.'</name>';
            echo '<student_info>'.$value->student_info.'</student_info>';
            echo '<photo>'.$value->photo.'</photo>';
            echo '</item>';
        }
        echo '</rss>';

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {;
            throw new Exception(implode("\n", $errors));
        }

// $this->_prepareDocument();
// parent::display($tpl);
    }


    /**
     * Prepares the document
     */
    protected function _prepareDocument()
    {
        $app        = JFactory::getApplication();
        $menus        = $app->getMenu();
        $title        = null;

        // Because the application sets a default page title,
        // we need to get it from the menu item itself
        $menu = $menus->getActive();
    }

}