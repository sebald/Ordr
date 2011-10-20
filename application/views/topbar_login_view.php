<?php
    $attributes_form = array(
            'class'        => 'pull-right'
          );
    $attributes_input_user = array(
            'class'        => 'input-small',
            'placeholder'  => 'Username'
          );
    $attributes_input_pwd = array(
            'class'        => 'input-small',
            'placeholder'  => 'Password'
          );
    $attributes_input_btn = array(
            'class'        => 'btn',
            'type'         => 'submit',
            'content'      => 'Sign in'
          );          

    echo form_open('account/sign_in', $attributes_form);
    echo form_input($attributes_input_user);
    echo form_password($attributes_input_pwd);
    echo form_button($attributes_input_btn);
    echo form_close();
          
?>