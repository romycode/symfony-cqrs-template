<?php

declare(strict_types=1);

namespace App\Application\Command\HelloWorld;

use App\Application\Command\CommandBusHandler;
use App\Application\UseCase\HelloWorld\CreateHelloWorldUseCase;
use App\Application\UseCase\HelloWorld\CreateHelloWorldUseCaseDTO;
use App\Domain\HelloWorld\Greeting;
use Throwable;

class CreateHelloWorldCommandHandler implements CommandBusHandler
{
    private CreateHelloWorldUseCase $useCase;

    public function __construct(CreateHelloWorldUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function __invoke(CreateHelloWorldCommand $command): void
    {
        try {
            // Start transaction
            $this->useCase->__invoke(
                new CreateHelloWorldUseCaseDTO(
                    new Greeting($command->getGreetingMessage())
                )
            );
            // Commit transaction
        } catch (Throwable $exception) {
            // Rollback transaction
            // Throw exception
        }
    }
}
