<?php

namespace AppBundle\Utils;


use AppBundle\Entity\News;
use Doctrine\Bundle\DoctrineBundle\Registry;

class Persistence
{
    protected static $instance;


    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    protected function __construct()
    {
    }

    public function findAll(Registry $entityManager)
    {
        $repository = $entityManager->getRepository(News::class);

        return $repository->findAll();
    }

    public function findOneBy($order, Registry $entityManager)
    {
        $repository = $entityManager->getRepository(News::class);

        return $repository->findBy(['alias' => $order])[0];
    }
}