<?php

namespace AppBundle\Utils;


use Symfony\Component\Form\Form;

class Validator
{
    protected $data;
    protected $form;


    public function __construct(Form $form, $data)
    {
        $this->data = $data;
        $this->form = $form;
    }

    public function isSubmitted()
    {

    }
}