<?php
namespace Lyssal\MoneyBundle\Command\Database;

use Lyssal\Dsv\Csv;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Config\FileLocatorInterface;
use Lyssal\MoneyBundle\Manager\CurrencyManager;

/**
 * A command to fill the currencies in database.
 */
class ImportCommand extends Command
{
    /**
     * @var \Symfony\Bridge\Doctrine\RegistryInterface The Doctrine registry
     */
    private $doctrine;

    /**
     * @var \Symfony\Component\Config\FileLocatorInterface The FileLocator
     */
    private $fileLocator;

    /**
     * @var \Lyssal\MoneyBundle\Manager\CurrencyManager The currency manager
     */
    private $currencyManager;

    /**
     * @var string Chemin vers le dossier de fichiers de LyssalMoneyBundle
     */
    private $filesPath;


    /**
     * Constructeur
     *
     * @param \Symfony\Bridge\Doctrine\RegistryInterface Doctrine $doctrine
     * @param \Symfony\Component\Config\FileLocatorInterface FileLocator $fileLocator
     * @param \Lyssal\MoneyBundle\Manager\CurrencyManager CurrencyManager $currencyManager
     */
    public function __construct(RegistryInterface $doctrine, FileLocatorInterface $fileLocator, CurrencyManager $currencyManager)
    {
        $this->doctrine = $doctrine;
        $this->fileLocator = $fileLocator;
        $this->currencyManager = $currencyManager;

        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName('lyssal:money:database:import')
            ->setDescription('Clean and fill the currencies')
        ;
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->doctrine->getConnection()->getConfiguration()->setSQLLogger(null);
        $this->initFilesPath();

        $this->importCurrencies();
    }

    /**
     * Init the files path.
     */
    private function initFilesPath()
    {
        foreach ($this->fileLocator->locate('@LyssalMoneyBundle', null, false) as $moneyBundlePath) {
            if (false !== strpos($moneyBundlePath, 'src/Lyssal/MoneyBundle')) {
                $this->filesPath = $moneyBundlePath.'../../../files';
                break;
            }
        }
    }

    /**
     * Import the currencies.
     */
    private function importCurrencies()
    {
        $csvFile = new Csv($this->filesPath.'/currencies.csv', ',', '"');
        $csvFile->import(false);
        $this->currencyManager->removeAll(true);

        foreach ($csvFile->getLines() as $currencyLine) {
            $symbol = $currencyLine[0];
            $code = $currencyLine[1];

            $currency = $this->currencyManager->create();
            $currency->setSymbol($symbol);
            $currency->setCode($code);

            $this->currencyManager->persist($currency);
        }

        $this->currencyManager->flush();
    }
}
