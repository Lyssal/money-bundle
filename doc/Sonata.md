# SonataAdmin

## Installation

1. Config

```yml
imports:
    - { resource: "@LyssalMoneyBundle/Resources/config/config/sonata.xml" }
```

## Inheritance

If you use your own admin classes, change the class parameters :

```xml
<parameters>
    <parameter key="lyssal.money.sonata.admin.currency.class">Acme\MoneyBundle\Sonata\Admin\CurrencyAdmin</parameter>
</parameters>
```
