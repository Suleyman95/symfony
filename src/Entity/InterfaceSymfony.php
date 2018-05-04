<?php

declare(strict_types=1);

Namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * InterfaceSymfony
 *
 * @ORM\Entity()
 */
class InterfaceSymfony
{
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
     * @ORM\Column(name="url", type="string")
     */
    private $url;
    /**
     * @ORM\ManyToOne(targetEntity="NamespaceSymfony", inversedBy="interfaces")
     */
    private $namespace;
    /**
     * @return mixed
     */
    public function getNamespace(): NamespaceSymfony
    {
        return $this->namespace;
    }
    /**
     * @param mixed $namespace
     *
     * @return InterfaceSymfony
     */
    public function setNamespace(NamespaceSymfony $namespace): InterfaceSymfony
    {
        $this->namespace = $namespace;
        return $this;
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
     * @return InterfaceSymfony
     */
    public function setName(string $name): InterfaceSymfony
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
        return $this->url;
    }
    /**
     * Set url
     *
     * @param string $url
     *
     * @return InterfaceSymfony
     */
    public function setUrl(string $url): InterfaceSymfony
    {
        $this->url = $url;
        return $this;
    }
}