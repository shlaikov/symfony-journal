<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\News;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class DefaultNewsData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $news = new News();
        $news->setTitle('Самый нулевой заголовок');
        $news->setBody('Самый нулевой пост');

        $manager->persist($news);
        $manager->flush();
    }
}