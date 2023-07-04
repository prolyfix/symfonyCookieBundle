<?php

namespace Prolyfix\SymfonyCookieNotificationBundle\Command;

use Prolyfix\SymfonyCookieNotificationBundle\Entity\CookiePartner;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Question\Question;

#[AsCommand(
    name: 'cookie:add-partner',
    description: 'Add an external partner to the cookie consent banner',
)]
class CookieAddPartnerCommand extends Command
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $helper = $this->getHelper('question');
        $question = new Question('What is the name of the new Partner?');
        $categoryName = $helper->ask($input, $output, $question);
        $question = new Question('What is the description of the new Partner?');
        $categoryDescription = $helper->ask($input, $output, $question);
        $partner = (new CookiePartner())
                        ->setDescription($categoryDescription)
                        ->setName($categoryName);
        $this->em->persist($partner);
        $this->em->flush();
        $io->success('A new partner has been added!');

        return Command::SUCCESS;
    }
}
