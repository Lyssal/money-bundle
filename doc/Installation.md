# Installation

1. Install the Lyssal Doctrine ORM bundle

See the official documentation.

2. Update your `composer.json` :

```json
"require": {
    "lyssal/money-bundle": "~x.y"
}
```

3. Update with Composer :

```sh
composer update
```

4. Create your money bundle (optional)

```php
namespace Acme\MoneyBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeMoneyBundle extends Bundle
{
    public function getParent()
    {
        return 'LyssalMoneyBundle';
    }
}
```

5. Update your `AppKernel.php` :

```php
new Lyssal\MoneyBundle\LyssalCurrencyBundle(),
new Acme\MoneyBundle\AcmeCurrencyBundle(),
```

6. Create your entity

```php
namespace Acme\MoneyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Lyssal\MoneyBundle\Entity\Currency as BaseCurrency;

/**
 * Currency.
 * 
 * @ORM\Entity()
 * @ORM\Table
 * (
 *     uniqueConstraints=
 *     {
 *         @UniqueConstraint(name="CODE", columns={ "code" }),
 *         @UniqueConstraint(name="SYMBOLE", columns={ "symbol" })
 *     }
 * )
 */
class Currency extends BaseCurrency
{
    
}
```

7. Redefine the parameters of the entities

```xml
<parameters>
    <parameter key="lyssal.money.entity.currency.class">Acme\MoneyBundle\Entity\Currency</parameter>
</parameters>
```

8. Update your database

```sh
php bin/console doctrine:schema:update --force
```
