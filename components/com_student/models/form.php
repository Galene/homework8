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

jimport('joomla.application.component.modelform');
jimport('joomla.event.dispatcher');


class StudentModelForm extends jModelForm
{
    protected function populateState()
    {
        $app = JFactory::getApplication('com_student');

        // Load state from the request userState on edit or from the passed variable on default
            $id = JFactory::getApplication()->input->get('id');
            JFactory::getApplication()->setUserState('com_student.edit.academicachievement.id', $id);

        $this->setState('academicachievement.id', $id);

        // Load the parameters.
        $params = $app->getParams();
        $params_array = $params->toArray();
        if(isset($params_array['item_id'])){
            $this->setState('academicachievement.id', $params_array['item_id']);
        }
        $this->setState('params', $params);

    }

    public function &getData($id = null)
    {
        if ($this->_item === null)
        {
            $this->_item = false;

            if (empty($id)) {
                $id = $this->getState('academicachievement.id');
            }

            // Get a level row instance.
            $table = $this->getTable();

            // Attempt to load the row.
            if ($table->load($id))
            {

                $user = JFactory::getUser();
                $id = $table->id;
                $canEdit = $user->authorise('core.edit', 'com_student') || $user->authorise('core.create', 'com_student');
                if (!$canEdit && $user->authorise('core.edit.own', 'com_student')) {
                    $canEdit = $user->id == $table->created_by;
                }

                // Check published state.
                if ($published = $this->getState('filter.published'))
                {
                    if ($table->state != $published) {
                        return $this->_item;
                    }
                }

                // Convert the JTable to a clean JObject.
                $properties = $table->getProperties(1);
                $this->_item = JArrayHelper::toObject($properties, 'JObject');
            } elseif ($error = $table->getError()) {
                $this->setError($error);
            }
        }

        return $this->_item;
    }

    public function getTable($type = 'Academicachievement', $prefix = 'StudentTable', $config = array())
    {
        $this->addTablePath(JPATH_COMPONENT_ADMINISTRATOR.'/tables');
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
        $form = $this->loadForm('com_student.form', 'form', array('control' => 'jform', 'load_data' => $loadData));
        if (empty($form)) {
            return false;
        }
        return $form;
    }


    protected function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState('com_student.edit.academicachievement.data', array());
        if (empty($data)) {
            $data = $this->getData();
        }
        return $data;
    }

    public function save($data)
    {
        $id = (!empty($data['id'])) ? $data['id'] : (int)$this->getState('academicachievement.id');
        $state = (!empty($data['state'])) ? 1 : 0;
        //$this->item->state = 1;
        //$state_string = 'Publish';
        //$state_value = 1;
        //$user = JFactory::getUser();

        $table = $this->getTable();
        if ($table->save($data) === true) {
            return $id;
        } else {
            return false;
        }

    }

}