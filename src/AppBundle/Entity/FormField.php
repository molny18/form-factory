<?php

declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class FormField
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="form_field");
 * @ORM\Entity(repositoryClass="Doctrine\ORM\EntityRepository")
 */
class FormField
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string",nullable=false)
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $type;

    /**
     * @ORM\Column(type="json_array", nullable=false)
     *
     * @var array
     */
    protected $options;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
    }



}
