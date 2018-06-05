<?php


namespace App\EventListener;


use App\Entity\Article;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class SearchIndexerSubscriber implements EventSubscriber
{

    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function getSubscribedEvents()
    {
        return array(
            'postPersist',
            'postUpdate',
        );
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    public function index(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        // perhaps you only want to act on some "Product" entity
        if ($entity instanceof Article) {
            $entityManager = $args->getEntityManager();
            //var_dump(777);
            $message = (new \Swift_Message('site update'))
                ->setFrom('youmsv@gmail.com')
                ->setTo('d_yates@mail.ru')
                ->setBody('texttexttexttext');

            $this->mailer->send($message);
        }
    }
}