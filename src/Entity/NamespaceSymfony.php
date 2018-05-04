<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;


/**
 * NamespaceSymfony
 *
 * @ORM\Entity()
 */
class NamespaceSymfony
{
    /**
     * @var NamespaceSymfony
     *
     * @ORM\ManyToOne(targetEntity="NamespaceSymfony", inversedBy="children")
     */
    private $parent;
    /**
     * @var NamespaceSymfony
     *
     * @ORM\OneToMany(targetEntity="NamespaceSymfony", mappedBy="parent")
     */
    private $children;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text")
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", nullable=true)
     */
    private $url;
    /**
     * @ORM\OneToMany(targetEntity="InterfaceSymfony", mappedBy="namespace")
     */
    private $interfaces;
    /**
     * @ORM\OneToMany(targetEntity="ClassSymfony", mappedBy="namespace")
     */
    private $classes;
    /**
     * NamespaceSymfony and ClassSymfony constructor
     */
    public function __construct()
    {
        $this->interfaces = new ArrayCollection();
        $this->classes = new ArrayCollection();
        $this->children = new ArrayCollection();
    }
    /**
     * @return NamespaceSymfony|null
     */
    public function getParent(): ?NamespaceSymfony
    {
        return $this->parent;
    }
    /**
     * @param NamespaceSymfony|null $parent
     *
     * @return NamespaceSymfony
     */
    public function setParent(?NamespaceSymfony $parent): NamespaceSymfony
    {
        $this->parent = $parent;
        return $this;
    }
    /**
     * @return ArrayCollection
     */
    public function getChildren(): ArrayCollection
    {
        return $this->children;
    }
    /**
     * @return mixed
     */
    public function getInterfaces(): ArrayCollection
    {
        return $this->interfaces;
    }
    /**
     * @return mixed
     */
    public function getClasses(): ArrayCollection
    {
        return $this->classes;
    }
    /**
     * Get id
     *
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->name;
    }
    /**
     * Set name
     *
     * @param string $name
     *
     * @return NamespaceSymfony
     */
    public function setName(string $name): NamespaceSymfony
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Get url
     *
     * @return string
     */
    public function getUrl(): string
    {
        return (string) $this->url;
    }
    /**
     * Set url
     *
     * @param string $url
     *
     * @return NamespaceSymfony
     */
    public function setUrl(string $url): NamespaceSymfony
    {
        $this->url = $url;
        return $this;
    }
    /**
     * Add interface
     *
     * @param \AppBundle\Entity\InterfaceSymfony $interface
     *
     * @return NamespaceSymfony
     */
    public function addInterface(InterfaceSymfony $interface): NamespaceSymfony
    {
        $this->interfaces[] = $interface;
        return $this;
    }
    /**
     * Remove interface
     *
     * @param \AppBundle\Entity\InterfaceSymfony $interface
     */
    public function removeInterface(InterfaceSymfony $interface)
    {
        $this->interfaces->removeElement($interface);
    }
    /**
     * Add class
     *
     * @param \AppBundle\Entity\ClassSymfony $class
     *
     * @return NamespaceSymfony
     */
    public function addClass(ClassSymfony $class): NamespaceSymfony
    {
        $this->classes[] = $class;
        return $this;
    }
    /**
     * Remove class
     *
     * @param \AppBundle\Entity\ClassSymfony $class
     */
    public function removeClass(ClassSymfony $class)
    {
        $this->classes->removeElement($class);
    }
    /**
     * Add children
     *
     * @param \AppBundle\Entity\NamespaceSymfony $children
     *
     * @return NamespaceSymfony
     */
    public function addChildren(NamespaceSymfony $children): NamespaceSymfony
    {
        $this->children[] = $children;
        return $this;
    }
    /**
     * Remove children
     *
     * @param \AppBundle\Entity\NamespaceSymfony $children
     *
     * @return NamespaceSymfony
     */
    public function removeChildren(NamespaceSymfony $children): NamespaceSymfony
    {
        $this->children->removeElement($children);
        return $this;
    }
}