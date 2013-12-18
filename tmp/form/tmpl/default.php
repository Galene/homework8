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

?>

<div class="item-fields">
    <h1>Введите данные про студента.</h1>

    <form id="form-academicachievement-delete-<?php echo $this->item->id; ?>" action="<?php echo JRoute::_('index.php?option=com_student&task=form.remove'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
        <input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
        <input type="hidden" name="jform[name]" value="<?php echo $this->item->name; ?>" />
        <input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
        <input type="hidden" name="jform[general_information]" value="<?php echo $this->item->general_information; ?>" />
        <input type="hidden" name="jform[sex]" value="<?php echo $this->item->sex; ?>" />
        <input type="hidden" name="jform[date_of_birth]" value="<?php echo $this->item->date_of_birth; ?>" />
        <input type="hidden" name="jform[group]" value="<?php echo $this->item->group; ?>" />
        <input type="hidden" name="jform[student_credit_book]" value="<?php echo $this->item->student_credit_book; ?>" />
        <input type="hidden" name="jform[the_average_score]" value="<?php echo $this->item->the_average_score; ?>" />
        <input type="hidden" name="jform[photo]" value="<?php echo $this->item->photo; ?>" />
        <input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>" />
        <input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />
        <input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />
        <input type="hidden" name="option" value="com_student" />
        <input type="hidden" name="task" value="form.remove" />
        <?php echo JHtml::_('form.token'); ?>
    </form>

    <form action="<?php echo JRoute::_( 'index.php?view=form' ) ?>" method="post" class="form-validate">

        <div class="control-group form-inline">
            <div class="control-label"><?php echo $this->form->getLabel( 'name' ); ?></div>
            <div class="controls"><?php echo $this->form->getInput( 'name' ); ?></div>
        </div>
        <div class="control-group form-inline">
            <div class="control-label"><?php echo $this->form->getLabel( 'email' ); ?></div>
            <div class="controls"><?php echo $this->form->getInput( 'email' ); ?></div>
        </div>
        <div class="control-group form-inline">
            <div class="control-label"><?php echo $this->form->getLabel( 'text' ); ?></div>
            <div class="controls"><?php echo $this->form->getInput( 'text' ); ?></div>
        </div>

        <input type="hidden" name="task" value="form.save" />
        <input type="submit" value="Отправить" />
        <?php echo JHtml::_( 'form.token' ); ?>
    </form>
</div>