<?

namespace Evolaze\Paiod\AppBundle\Entity\Keyvalue;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="cache_items")
 */
class CacheItems
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $itemId;

    /**
     * @ORM\Column(type="blob", nullable=false)
     */
    protected $itemData;

    /**
     * @ORM\Column(type="integer")
     */
    protected $itemLifetime;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $itemTime;

    /**
     * @return mixed
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * @param mixed $itemId
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;
    }

    /**
     * @return mixed
     */
    public function getItemData()
    {
        return $this->itemData;
    }

    /**
     * @param mixed $itemData
     */
    public function setItemData($itemData)
    {
        $this->itemData = $itemData;
    }

    /**
     * @return mixed
     */
    public function getItemLifetime()
    {
        return $this->itemLifetime;
    }

    /**
     * @param mixed $itemLifetime
     */
    public function setItemLifetime($itemLifetime)
    {
        $this->itemLifetime = $itemLifetime;
    }

    /**
     * @return mixed
     */
    public function getItemTime()
    {
        return $this->itemTime;
    }

    /**
     * @param mixed $itemTime
     */
    public function setItemTime($itemTime)
    {
        $this->itemTime = $itemTime;
    }
}