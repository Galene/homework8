<?php
/**
 * @version     1.0.2
 * @package     com_student
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Gala <galina.ck@gmail.com> - http://
 */
// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_student', JPATH_ADMINISTRATOR);

$doc = JFactory::getDocument();
$doc->addStyleSheet(JURI::root(true)."/components/com_student/style.css");
?>


<script type="text/javascript">
    function getScript(url,success) {
        var script = document.createElement('script');
        script.src = url;
        var head = document.getElementsByTagName('head')[0],
        done = false;
        // Attach handlers for all browsers
        script.onload = script.onreadystatechange = function() {
            if (!done && (!this.readyState
                || this.readyState == 'loaded'
                || this.readyState == 'complete')) {
                done = true;
                success();
                script.onload = script.onreadystatechange = null;
                head.removeChild(script);
            }
        };
        head.appendChild(script);
    }
    getScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js',function() {
        js = jQuery.noConflict();
        js(document).ready(function(){
            js('#form-academicachievement').submit(function(event){
                 
            }); 
        
            
        });
    });
    
</script>

<div class="academicachievement-edit front-end-edit">
    <?php if (!empty($this->item->id)): ?>
        <h1>Edit <?php echo $this->item->id; ?></h1>
    <?php else: ?>
        <h1>Enter information about  student:</h1>
    <?php endif; ?>

    <form id="form-academicachievement" action="<?php echo JRoute::_('index.php?option=com_student&task=academicachievement.save'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
        <ul>
            	<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
                <input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
				<li><?php echo $this->form->getLabel('name'); ?><br>
                    <?php echo $this->form->getInput('name'); ?></li>
                <li><?php echo $this->form->getLabel('email'); ?><br>
                    <?php echo $this->form->getInput('email'); ?></li>
                <li ><?php echo $this->form->getLabel('general_information'); ?>
                    <?php echo $this->form->getInput('general_information'); ?></li>
				<li style="clear: left"><?php echo $this->form->getLabel('sex'); ?>
                    <?php echo $this->form->getInput('sex'); ?></li>
				<li><?php echo $this->form->getLabel('date_of_birth'); ?><br>
                    <?php echo $this->form->getInput('date_of_birth'); ?></li>
				<li><?php echo $this->form->getLabel('group'); ?><br>
                    <?php echo $this->form->getInput('group'); ?></li>
				<li><?php echo $this->form->getLabel('student_credit_book'); ?><br>
                    <?php echo $this->form->getInput('student_credit_book'); ?></li>
				<li><?php echo $this->form->getLabel('the_average_score'); ?><br>
                    <?php echo $this->form->getInput('the_average_score'); ?></li>
				<li><?php echo $this->form->getLabel('photo'); ?><br>
                    <?php echo $this->form->getInput('photo'); ?></li>

				<?php if(empty($this->item->created_by)){?><input type="hidden" name="jform[created_by]" value="<?php echo JFactory::getUser()->id; ?>" />	<?php }
				    else{?><input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>" /><?php } ?>
            <!--
            <?php $canState = false; ?>
			<?php $canState = $canState = JFactory::getUser()->authorise('core.edit.state','com_student'); ?>
            <?php if(!$canState): ?>
					<li><?php echo $this->form->getLabel('state'); ?>
					<?php
						$state_string = 'Unpublish';
						$state_value = 0;
						if($this->item->state == 1):
							$state_string = 'Publish';
							$state_value = 1;
						endif;
						echo $state_string; ?></li>
					<input type="hidden" name="jform[state]" value="<?php echo $state_value; ?>" />				<?php else: ?>					<li><?php echo $this->form->getLabel('state'); ?>
					<?php echo $this->form->getInput('state'); ?></li>
				<?php endif; ?>-->
        </ul>

        <div class="subbat">
            <button type="submit" class="validate"><span><?php echo JText::_('JSUBMIT'); ?></span></button>
            <?php echo JText::_('or'); ?>
            <a href="<?php echo JRoute::_('index.php?option=com_student&task=academicachievement.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>

            <input type="hidden" name="option" value="com_student" />
            <input type="hidden" name="task" value="academicachievementform.save" />

            <?php echo JHtml::_('form.token'); ?>
        </div>
    </form>
</div>
