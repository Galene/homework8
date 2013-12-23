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

<div class="front-end-edit">
    <h1>Введите данные про студента.</h1>

    <!--
    <form action="<?php echo JRoute::_( 'index.php?view=form' ) ?>" method="post" class="form-validate">
        <div class="front-edit"><?php echo $this->form->getLabel( 'name' ); ?></div>
        <input tipe=text name="name" class="required" />
        <div class="front-edit"><?php echo $this->form->getLabel( 'student_credit_book' ); ?></div>
        <input tipe=text name="student_credit_book" class="required" />
        <div class="front-edit"><?php echo $this->form->getLabel( 'general_information' ); ?></div>
        <textarea rows="10" cols="45" name="general_information"></textarea>
        <div class="front-edit"><?php echo $this->form->getLabel( 'group' ); ?></div>
        <input tipe=text name="group" class="required" />
        <div class="front-edit"><?php echo $this->form->getLabel( 'the_average_score' ); ?></div>
        <input tipe=text name="the_average_score" class="required" />-->



        <div class="control-group form-inline">
            <div class="control-label"><?php echo $this->form->getLabel( 'name' ); ?></div>
            <div class="controls"><?php echo $this->form->getInput( 'name' ); ?></div>
        </div>
        <div class="control-group form-inline">
            <div class="control-label"><?php echo $this->form->getLabel( 'email' ); ?></div>
            <div class="controls"><?php echo $this->form->getInput( 'email' ); ?></div>
        </div>
        <div class="control-group form-inline">
            <div class="control-label"><?php echo $this->form->getLabel( 'student_credit_book' ); ?></div>
            <div class="controls"><?php echo $this->form->getInput( 'student_credit_book' ); ?></div>
        </div>
        <div class="control-group form-inline">
            <div class="control-label"><?php echo $this->form->getLabel( 'general_information' ); ?></div>
            <div class="controls"><?php echo $this->form->getInput( 'general_information' ); ?></div>
        </div>
        <div class="control-group form-inline">
            <div class="control-label"><?php echo $this->form->getLabel( 'group' ); ?></div>
            <div class="controls"><?php echo $this->form->getInput( 'group' ); ?></div>
        </div>
        <div class="control-group form-inline">
            <div class="control-label"><?php echo $this->form->getLabel( 'the_average_score' ); ?></div>
            <div class="controls"><?php echo $this->form->getInput( 'the_average_score' ); ?></div>
        </div>

        <!--<div class="subbat">
            <button type="submit" class="validate"><span><?php echo JText::_('JSUBMIT'); ?></span></button></div>-->
        <div>
        <input type="hidden" name="option" value="com_student" />
        <input type="hidden" name="task" value="academicachievementform.save" />
        <input type="submit" value="Отправить" />
        <?php echo JHtml::_( 'form.token' ); ?>
        </div>
    </form>
</div>