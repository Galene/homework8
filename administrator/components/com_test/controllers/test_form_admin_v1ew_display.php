<?php
/**
 * @version     1.0.1
 * @package     com_test
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Gala <galina.ck@gmail.com> - http://
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Test_form_admin_v1ew_display controller class.
 */
class TestControllerTest_form_admin_v1ew_display extends JControllerForm
{

    function __construct() {
        $this->view_list = 'test_list_admin_v1ew_plural_name';
        parent::__construct();
    }

}