<?php
    $attr_form = array(           
            'class'        => 'pull-right'
          );
    $attr_input_user = array(
            'name'        => 'username',     
            'class'        => 'input-small',
            'placeholder'  => 'Username'
          );
    $attr_input_pwd = array(
            'name'        => 'password',     
            'class'        => 'input-small',
            'placeholder'  => 'Password'
          );
    $attr_input_btn = array(
            'class'        => 'btn',
            'type'         => 'submit',
            'content'      => 'Log in'
          );          

    echo form_open('account/login', $attr_form);
    echo form_input($attr_input_user);
    echo form_password($attr_input_pwd);
    echo form_button($attr_input_btn);
    echo form_close();
          
?>