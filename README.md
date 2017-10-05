# The Lyssal money bundle

This bundle permits to manage currencies with the Lyssal Doctrine ORM bundle.


## Installation

Read the [installation documentation](doc/Installation.md).


## Manager

The service are :

* lyssal.money.manager.currency

```php
$currencies = $this->container->get('lyssal.money.manager.currency')->findAll();
```

### Inheritance

Create your manager and change the manager class parameter :

```xml
<parameters>
    <parameter key="lyssal.money.manager.currency.class">Acme\MoneyBundle\Manager\CurrencyManager</parameter>
</parameters>
```


## Optional

* [SonataAdmin](doc/Sonata.md)


## Command

### Import data

Empty and import currencies :

```sh
lyssal:monney:database:import
```


## PhpDoc

Execute :

```sh
phpdoc -c doc/phpdoc.tpl.xml
```
