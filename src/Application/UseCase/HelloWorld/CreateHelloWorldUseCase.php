<?php

declare(strict_types=1);

namespace App\Application\UseCase\HelloWorld;

use App\Application\Event\EventBus;
use App\Domain\HelloWorld\HelloWorld;
use App\Domain\HelloWorld\WriteHelloWorldRepository;

class CreateHelloWorldUseCase
{
    private WriteHelloWorldRepository $repository;
    private EventBus $eventBus;

    public function __construct(WriteHelloWorldRepository $repository, EventBus $eventBus)
    {
        $this->repository = $repository;
        $this->eventBus = $eventBus;
    }

    public function __invoke(CreateHelloWorldUseCaseDTO $dto): void
    {
        $helloWorld = new HelloWorld(
            $dto->getGreeting()
        );
        $this->repository->save($helloWorld);
        $this->eventBus->publish(...$helloWorld->pullDomainEvents());
    }
}
