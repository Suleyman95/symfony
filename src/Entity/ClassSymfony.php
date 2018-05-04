<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * ClassSymfony
 *
 * @ORM\Entity()
 */
class ClassSymfony
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
     * @ORM\ManyToOne(targetEntity="NamespaceSymfony", inversedBy="classes")
     */
    private $namespace;
    /**
     * Get namespace
     *
     * @return mixed
     */
    public function getNamespace(): NamespaceSymfony
    {
        return $this->namespace;
    }
    /**
     * Set namespace
     *
     * @param mixed $namespace
     *
     * @return ClassSymfony
     */
    public function setNamespace(NamespaceSymfony $namespace): ClassSymfony
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
     * @return ClassSymfony
     */
    public function setName(string $name): CLassSymfony
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
     * @return ClassSymfony
     */
    public function setUrl(string $url): ClassSymfony
    {
        $this->url = $url;
        return $this;
    }
}