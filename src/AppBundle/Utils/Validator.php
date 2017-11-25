<?php

namespace AppBundle\Utils;


use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Form\Form;

class Validator
{
    protected $data;
    protected $form;
    protected $manager;


    public function __construct(Form $form, Registry $manager, $data)
    {
        $this->data = $data;
        $this->form = $form;
        $this->manager = $manager;
    }

    public function isSubmitted()
    {
        $form = $this->form;

        if ($form->isSubmitted() && $form->isValid()) {
            return true;
        } else {
            return false;
        }
    }
}