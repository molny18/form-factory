<?php

declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class FormField.
 *
 * @ORM\Entity
 * @ORM\Table(name="form_field_instance");
 * @ORM\Entity(repositoryClass="Doctrine\ORM\EntityRepository")
 */
class FormFieldInstance
{
    //FORM_ID -t is tároljuk (? lehet h a position-t is itt kéne !! )
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    protected $field_id;

    /**
     * @ORM\Column(type="json_array",nullable=false)
     *
     * @var array
     */
    protected $instance_options;

    /**
     * @ORM\Column(type="integer", nullable=false)
     *
     * @var int
     */
    protected $form_id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getFieldId(): ?int
    {
        return $this->field_id;
    }

    /**
     * @param int $field_id
     */
    public function setFieldId(int $field_id)
    {
        $this->field_id = $field_id;
    }

    /**
     * @return array
     */
    public function getInstanceOptions(): ?array
    {
        return $this->instance_options;
    }

    /**
     * @param array $instance_options
     */
    public function setInstanceOptions(array $instance_options)
    {
        $this->instance_options = $instance_options;
    }

    /**
     * @return int
     */
    public function getFormId(): ?int
    {
        return $this->form_id;
    }

    /**
     * @param int $form_id
     */
    public function setFormId(int $form_id)
    {
        $this->form_id = $form_id;
    }
}
