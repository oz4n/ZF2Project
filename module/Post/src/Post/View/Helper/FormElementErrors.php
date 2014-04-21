<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Post\View\Helper;

use Zend\Form\View\Helper\FormElementErrors as OriginalFormElementErrors;

/**
 * Description of FormElementErrors
 *
 * @author melengo
 */
class formElementErrors extends OriginalFormElementErrors
{

    protected $messageCloseString = '</p></div>';
    protected $messageOpenFormat = '<div class="has-error"><p class="help-block">';
    protected $messageSeparatorString = '';

}
