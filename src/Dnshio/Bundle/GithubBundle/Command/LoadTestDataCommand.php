<?php
namespace Dnshio\Bundle\GithubBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LoadTestDataCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('db:load_fixtures')
            ->setDescription('Loads test data fixtures');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("<comment>Loading test data</comment>");
        $this->getContainer()->get('dnshio.repository.github_api_mock')->loadTestData();
        $output->writeln("<info>Done</info>");
    }

}
