<?php

declare(strict_types=1);

namespace AppBundle\Services;

use AppBundle\Entity\FormEntity;
use AppBundle\Entity\FormField;
use AppBundle\Entity\FormFieldInstance;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormFactory;

class FromRenderHelper extends \Twig_Extension
{
    /**
     * @var EntityRepository
     */
    protected $manager;

    /**
     * @var EntityRepository
     */
    protected $instanceManager;

    /**
     * @var EntityRepository
     */
    protected $fieldManager;

    /**
     * @var FormFactory
     */
    protected $formFactory;

    /**
     * @param EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->manager = $entityManager->getRepository(FormEntity::class);
        $this->instanceManager = $entityManager->getRepository(FormFieldInstance::class);
        $this->fieldManager = $entityManager->getRepository(FormField::class);
    }

    /**
     * @param FormFactory $formFactory
     */
    public function setFormFactory(FormFactory $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('showForm',function ($name){
                $this->render($name);
            },[])
        ];
    }


    public function render($name)
    {
        $formData = $this->findForm($name);
        $fieldIsntances = $this->instanceManager->findBy(['id' => $formData->getFields()]);
        $baseFields = $this->fieldManager->findBy(['id' => $formData->getFields()]);
        var_dump($fieldIsntances);
        echo 'asd';
    }

    private function findForm(string $name):FormEntity
    {
        $form = $this->manager->findBy(['name' => $name]);

        return $form[0];
    }

}
