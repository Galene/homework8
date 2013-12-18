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

//JFormHelper::loadFieldClass('list');

//class JFormFieldHelloWorld extends JFormFieldList

class StudentModelForm extends jModelForm{

    function getForm($data = array(), $loadData = true)
    {
echo 'qwer';
    }


    function submit()
    {
        $mainframe = JFactory::getApplication();
        $params = clone($mainframe->getParams('com_student'));
        // Initialize some variables
        $db			= JFactory::getDBO();
        $SiteName	= JURI::base();
        $uri64		= JRequest::getVar( 'code2',				'',			'post' );
        $name		= JRequest::getVar( 'contactmap_nom',		'',			'post' );
        $email		= JRequest::getVar( 'contactmap_email',		'',			'post' );
        $subject	= JRequest::getVar( 'contactmap_subject',	$default,	'post' );
        $body		= JRequest::getVar( 'contactmap_message',	'',			'post' );
        $emailCopy	= JRequest::getInt( 'contact_email_copy', 	0,			'post' );
    }
}