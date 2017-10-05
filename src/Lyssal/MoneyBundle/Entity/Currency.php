<?php
namespace Lyssal\MoneyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Currency.
 *
 * @ORM\MappedSuperclass()
 */
abstract class Currency
{
    /**
     * @var integer The ID
     *
     * @ORM\Column(type="smallint", nullable=false, options={"unsigned":true})
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string The code
     *
     * @ORM\Column(type="string", nullable=false, length=3)
     * @Assert\NotBlank()
     */
    protected $code;

    /**
     * @var string The symbol
     *
     * @ORM\Column(type="string", nullable=false, length=3)
     * @Assert\NotBlank()
     */
    protected $symbol;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Currency
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set symbol
     *
     * @param string $symbol
     * @return Currency
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * Get symbol
     *
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->code;
    }
}
