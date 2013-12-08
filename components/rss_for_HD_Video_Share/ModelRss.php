<?php

/**
 * @version 1.0.0
 * @package com_studentslist
 * @copyright © 2013. Все права защищены.
 * @license GNU General Public License версии 2 или более поздней; Смотрите LICENSE.txt
 * @author Marina <marinka.derkach@gmail.com> - http://
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Studentslist records.
 */
class StudentslistModelRss extends JModelList {

    /**
     * Constructor.
     *
     * @param array An optional associative array of configuration settings.
     * @see JController
     * @since 1.6
     */
    public function __construct($config = array()) {
        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @since        1.6
     */
    protected function populateState($ordering = null, $direction = null) {

        // Initialise variables.
        $app = JFactory::getApplication();

        // List state information
        $limit = $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'));
        $this->setState('list.limit', $limit);

        $limitstart = JFactory::getApplication()->input->getInt('limitstart', 0);
        $this->setState('list.start', $limitstart);


        if(empty($ordering)) {
            $ordering = 'a.ordering';
        }

        // List state information.
        parent::populateState($ordering, $direction);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return        JDatabaseQuery
     * @since        1.6
     */
    protected function getListQuery() {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
            $this->getState(
                'list.select', 'a.*'
            )
        );

        $query->from('`#__studentslist_students` AS a');


        // Join over the users for the checked out user.
        $query->select('uc.name AS editor');
        $query->join('LEFT', '#__users AS uc ON uc.id=a.checked_out');

        // Join over the created by field 'created_by'
        $query->select('created_by.name AS created_by');
        $query->join('LEFT', '#__users AS created_by ON created_by.id = a.created_by');



        return $query;
    }

    public function getItems() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('name, student_info, photo');
        $query->from('#__studentslist_students');
        $db->setQuery((string)$query);
        $students = $db->loadObjectList();
        return $students;
    }

}