<?php

namespace SilexDemo\subscriptionform\app\controller;

use Monolog\Handler\StreamHandler;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Monolog\Logger;

class ApplicationController
{

    const MAX_NAME_LENGTH = 255;
    const MIN_NAME_LENGTH = 5;

    /**
     * @param Application $application
     * @param Request $request
     * @return mixed
     */
    public function subscribe(Application $application, Request $request)
    {
        $form = $application['form.factory']->createBuilder('form')
            ->add('name', 'text', array(
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array('min' => self::MIN_NAME_LENGTH, 'max' => self::MAX_NAME_LENGTH))
                ),
                'attr' => array('class' => 'form-control', 'placeholder' => 'Your name')
            ))
            ->add('email', 'email', array(
                'constraints' => array(new Assert\Email()),
                'attr' => array('class' => 'form-control', 'placeholder' => 'Your e-mail adress')
            ))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $subscriber = $form->getData();
            #emailing a confirmation message
            $message = \Swift_Message::newInstance()
                ->setSubject('Confirmation of your subscription')
                ->setFrom(array('noreply@example.com' => 'Subscription Service'))
                ->setTo($subscriber['email'])
                ->setBody(sprintf('Dear %s, this is a confirmation that you are now subscribe...', $subscriber['name']));
            $application['mailer']->send($message);
            #logging the subscription
            #should be directly translatable to a MonologServiceProvider using Silex's built in service
            $logger = new Logger('Subscription');
            $logger->pushHandler(new StreamHandler(__DIR__ . '/../../log/subscription.log', Logger::INFO));
            $logger->addInfo(sprintf("User '%s' subscribed with email '%s'.", $subscriber['name'],
                $subscriber['email']));
            #making a subquery
            $subRequest = Request::create('/summary', 'GET', $subscriber);
            $application['session']->set('subscriber', $subscriber);
            return $application->handle($subRequest, HttpKernelInterface::SUB_REQUEST, false);
        }
        return $application['twig']->render('subscribe.twig', array('form' => $form->createView()));
    }

    /**
     * @param Application $application
     * @param Request $request
     * @return mixed
     */
    public function summary(Application $application, Request $request)
    {
        $subscriber = $application['session']->get('subscriber');
        return $application['twig']->render('summary.twig', array('subscriber' => $subscriber));
    }
}
