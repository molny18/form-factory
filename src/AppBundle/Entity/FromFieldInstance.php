<?php

declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class FormField
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="form_field_instance");
 * @ORM\Entity(repositoryClass="Doctrine\ORM\EntityRepository")
 */
class FromFieldInstance
{

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
    
    //FORM_ID -t is tároljuk (? lehet h a position-t is itt kéne !! )
}
