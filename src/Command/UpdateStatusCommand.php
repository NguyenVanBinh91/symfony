<?php
namespace App\Command;
use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// the name of the command is what users type after "php bin/console"
#[AsCommand(name: 'update-status')]
class UpdateStatusCommand extends Command
{
  private $entityManager;

  public function __construct(BookRepository $bookRepository)
  {
    $this->entityManager = $bookRepository;
    parent::__construct();
  }
  protected function execute(InputInterface $input, OutputInterface $output): int
  {

    $book = $this->entityManager->find(4);

    $status = $book->getStatus();
    $check_status = $status == 1?2:1;
    $book->setStatus($check_status);
    $this->entityManager->persist($book);
    $this->entityManager->flush();
    $output->writeln('Update status successfully!');
    return 0;
  }
  protected function configure(): void
    {
        // $this
        //     ->addArgument('id', InputArgument::REQUIRED, 'The post id of the user.')
        //     // the command help shown when running the command with the "--help" option
        //     ->setHelp('This command allows you to update a post state...')
        // ;
    }
}