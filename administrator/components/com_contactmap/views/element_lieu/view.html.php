<?php
	/*
	* ContactMap Component Google Map for Joomla! 2.5.x
	* Version 4.13
	* Creation date: Mars 2013
	* Author: Fabrice4821 - www.gmapfp.org
	* Author email: webmaster@gmapfp.org
	* License GNU/GPL
	*/

defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

class ContactMapsViewElement_lieu extends JView
{
	function display($tpl = null)
	{
		$mainframe = JFactory::getApplication(); 
		$option    = JRequest::getCMD('option'); 
		$option = $option.'_lieux';

		JHTML::_('behavior.tooltip');

		// Get data from the model
		$items	= $this->get( 'Data');
		$this->assignRef('items',	$items);

		$pageNav = $this->get( 'Pagination' );				
		$this->assignRef('pageNav', $pageNav);

			$filtrevilles = array();
			$filtrevilles[] = JHTML::_('select.option', '', '-- '.JText::_( 'GMAPFP_VILLE_FILTRE' ).' --' );
					foreach($this->get('listville') as $temp) {
						if ($temp->suburb) $filtrevilles[] = JHTML::_('select.option', $temp->suburb );
					}
	
			$filtredepartements = array();
			$filtredepartements[] = JHTML::_('select.option', '', '-- '.JText::_( 'GMAPFP_DEPARTEMENT_FILTRE' ).' --' );
					foreach($this->get('listdepartement') as $temp) {
						if ($temp->state) $filtredepartements[] = JHTML::_('select.option', $temp->state );
					}
					
			$filter_order = $mainframe->getUserStateFromRequest($option.'filter_order', 'filter_order', 'nom', 'cmd');
			$filter_order_Dir = $mainframe->getUserStateFromRequest($option.'filter_order_Dir', 'filter_order_Dir', '', 'word');
			$search_lieu	= $mainframe->getUserStateFromRequest($option.'search_lieu', 'search_lieu', '',	'string' );
			$filtreville = $mainframe->getUserStateFromRequest($option.'filtreville', 'filtreville', '-- '.JText::_( 'GMAPFP_VILLE' ).' --', 'string' );
			$filtredepartement = $mainframe->getUserStateFromRequest($option.'filtredepartement', 'filtredepartement', '-- '.JText::_( 'GMAPFP_DEPARTEMENT' ).' --', 'string' );
			$lists['ville'] = JHTML::_('select.genericlist', $filtrevilles,'filtreville', 'size="1" class="inputbox" onchange="form.submit()"', 'value', 'text', $filtreville );
			$lists['departement'] = JHTML::_('select.genericlist', $filtredepartements, 'filtredepartement', 'size="1" class="inputbox" onchange="form.submit()"', 'value', 'text', $filtredepartement );
			$lists['order_Dir'] = $filter_order_Dir;
			$lists['order'] = $filter_order;
			$lists['search_lieu'] = $search_lieu;
			$this->assignRef('lists', $lists);

		parent::display($tpl);

	}
}
