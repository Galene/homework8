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
jimport('joomla.application.component.model');

class ContactMapsModelContactMap extends JModel
{
    var $_list;

    function __construct()
    {
        parent::__construct();

        $array = JRequest::getVar('cid',  0, '', 'array');
        $this->setId((int)$array[0]);
    }

    function _buildQuery()
    {
        $query = ' SELECT * '
            . ' FROM #__contactmap_marqueurs '
        ;

        return $query;
    }

    function setId($id)
    {
        // Set id and wipe data
        $this->_id      = $id;
        $this->_data    = null;
    }

    function &getData()
    {
        // Load the data
        if (empty( $this->_data )) {
            $query = ' SELECT a.*, u.name AS user_name'.
					' FROM #__contact_details a '.
					' LEFT OUTER JOIN #__users u ON a.user_id = u.id'.
                    ' WHERE a.id = '.$this->_id;
            $this->_db->setQuery( $query );
            $this->_data = $this->_db->loadObject();
        }
        if (!$this->_data) {
            $this->_data = new stdClass();
            $this->_data->id = 0;
            $this->_data->name = null;
            $this->_data->alias = null;
            $this->_data->con_position = null;
            $this->_data->address = null;
            $this->_data->postcode = null;
            $this->_data->suburb = null;
            $this->_data->state = null;
            $this->_data->country = null;
            $this->_data->telephone = null;
            $this->_data->mobile = null;
            $this->_data->fax = null;
            $this->_data->email_to = null;
            $this->_data->webpage = null;
            $this->_data->image = null;
            $this->_data->imagepos = null;
            $this->_data->misc = null;
            $this->_data->message = null;
            $this->_data->horaires_prix = null;
            $this->_data->affichage = null;
            $this->_data->marqueur = null;
            $this->_data->link = null;
            $this->_data->article_id = 0;
            $this->_data->icon = null;
            $this->_data->icon_label = null;
            $this->_data->glat = null;
            $this->_data->glng = null;
            $this->_data->gzoom = null;
            $this->_data->catid = null;
            $this->_data->user_id = null;
            $this->_data->user_name = null;
            $this->_data->published = null;
            $this->_data->checked_out = null;
            $this->_data->metadesc = null;
            $this->_data->metakey = null;
            $this->_data->ordering = 0;         
            $this->_data->default_con = null;         
            $this->_data->checked_out_time = '0000-00-00 00:00:00';         
            $this->_data->params = null;         
            $this->_data->access = null;         
        }
        
        if (JString::strlen($this->_data->message) > 1) {
            $this->_data->text = $this->_data->misc . "<hr id=\"system-readmore\" />" . $this->_data->message;
        } else {
            $this->_data->text = $this->_data->misc;
        }
        return $this->_data;
    }

    function &getMarqueurs()
    {
        if (empty( $this->_list ))
        {
            $query = $this->_buildQuery();
            $this->_list = $this->_getList( $query );
        }

        return $this->_list;
    }

    function store()
    {
        $row =& $this->getTable('ContactMap', 'ContactMapTable');

        $data = JRequest::get( 'post' );

        // Prepare the content for saving to the database
        ContactMapHelpers::saveContactMapPrep( $row );

        // Bind the form fields to the table
        if (!$row->bind($data)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        // Make sure the record is valid
        if (!$row->check()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }
        
        // Store the web link table to the database
        if (!$row->store()) {
            $this->setError( $this->_db->getErrorMsg() );
            return false;
        }
        
        // attribut le n� 1 � ordering et d�cale les autres n�
        if (!$row->reorder()) {
            $this->setError( $this->_db->getErrorMsg() );
            return false;
        }
        
        return $row->id;
    }

    function delete()
    {
        $cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );

        $row =& $this->getTable('ContactMap', 'ContactMapTable');

        if (count( $cids ))
        {
            foreach($cids as $cid) {
                if (!$row->delete( $cid )) {
                    $this->setError( $row->getErrorMsg() );
                    return false;
                }
            }                       
        }
        return true;
    }
    
    function move($direction)
    {
        $row =& $this->getTable('ContactMap', 'ContactMapTable');
        if (!$row->load($this->_id)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        if (!$row->move( $direction, ' true AND published >= 0 ' )) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        return true;
    }

    function saveorder($cid = array(), $order)
    {
        $row =& $this->getTable('ContactMap', 'ContactMapTable');
        //$groupings = array();

        // update ordering values
        for( $i=0; $i < count($cid); $i++ )
        {
            $row->load( (int) $cid[$i] );
            // track categories
            //$groupings[] = $row->catid;

            if ($row->ordering != $order[$i])
            {
                $row->ordering = $order[$i];
                if (!$row->store()) {
                    $this->setError($this->_db->getErrorMsg());
                    return false;
                }
            }
        }

        $row->reorder();

        return true;
    }

    function getcategorie()
    {
        $query = 'SELECT id' .
                ' FROM #__categories' .
                ' WHERE extension = "com_contact_details"' .
                ' ORDER BY title';
        return $this->_getList( $query );
    }

}
?>
