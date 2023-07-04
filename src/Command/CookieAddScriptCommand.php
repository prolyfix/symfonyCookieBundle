<?php

namespace Prolyfix\SymfonyCookieNotificationBundle\Command;

use Prolyfix\SymfonyCookieNotificationBundle\Entity\CookieCategory;
use Prolyfix\SymfonyCookieNotificationBundle\Entity\CookiePartner;
use Prolyfix\SymfonyCookieNotificationBundle\Entity\CookieScript;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Question\Question;

#[AsCommand(
    name: 'cookie:add-script',
    description: 'Add a script to the cookie consent banner',
)]
class CookieAddScriptCommand extends Command
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
        $question = new Question('What is the name of the script?');
        $name = $helper->ask($input, $output, $question);
        $question = new Question('What is the script?');
        $script = $helper->ask($input, $output, $question);
        $question = new Question('What is the description of the script?');
        $description = $helper->ask($input, $output, $question);        
        $categories = $this->em->getRepository(CookieCategory::class)->findAll();
        $categoryNames = [];
        foreach($categories as $category){
            $categoryNames[] = $category->getName();
        }
        $quest = new ChoiceQuestion('to which Category does it belong?',$categoryNames);
        $category = $helper->ask($input, $output, $quest);
        $quest = new ChoiceQuestion('is the script related to a partner?',['yes','no']);
        $partner = null;
        if($quest == "yes"){
            $partners = $this->em->getRepository(CookiePartner::class)->findAll();
            $partnerNames = [];
            foreach($partners as $partner){
                $partnerNames[] = $partner->getName();
            }
            $quest = new ChoiceQuestion('to which Partner does it belong?',$partnerNames);
            $partner = $helper->ask($input, $output, $quest);
        }
        $script = (new CookieScript())
                        ->setScript($script)
                        ->setDescription($description)
                        ->setName($name)
                        ->setCategory($this->em->getRepository(CookieCategory::class)->findOneByName($category))
                        ->setPartner($this->em->getRepository(CookiePartner::class)->findOneByName($category));

        $this->em->persist($script);
        $this->em->flush();
        $io->success('A new script has been added!');

        return Command::SUCCESS;
    }
}
