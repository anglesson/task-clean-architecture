<?php

use App\ToDo\Application\Presenters\CreateTask\CreateTaskPresenter;
use App\ToDo\Application\Presenters\CreateTask\CreateTaskPresenterImpl;
use App\ToDo\Application\Presenters\ListTask\ListTaskPresenter;
use App\ToDo\Application\Presenters\ListTask\ListTaskPresenterImpl;
use App\ToDo\Application\Presenters\ReadTask\ReadTaskPresenter;
use App\ToDo\Application\Presenters\ReadTask\ReadTaskPresenterImpl;
use App\ToDo\Application\Presenters\UpdateTask\UpdateTaskPresenter;
use App\ToDo\Application\Presenters\UpdateTask\UpdateTaskPresenterImpl;
use App\ToDo\Domain\Protocols\TaskRepository;
use App\ToDo\Domain\Protocols\UuidGenerator;
use App\ToDo\Domain\UseCases\CreateTask\CreateTaskUseCase;
use App\ToDo\Domain\UseCases\CreateTask\CreateTaskUseCaseImpl;
use App\ToDo\Domain\UseCases\DeleteTask\DeleteTaskUseCase;
use App\ToDo\Domain\UseCases\DeleteTask\DeleteTaskUseCaseImpl;
use App\ToDo\Domain\UseCases\ListTasks\ListTasksUseCase;
use App\ToDo\Domain\UseCases\ListTasks\ListTasksUseCaseImpl;
use App\ToDo\Domain\UseCases\ReadTask\ReadTaskUseCase;
use App\ToDo\Domain\UseCases\ReadTask\ReadTaskUseCaseImpl;
use App\ToDo\Domain\UseCases\UpdateTask\UpdateTaskUseCase;
use App\ToDo\Domain\UseCases\UpdateTask\UpdateTaskUseCaseImpl;
use App\ToDo\Domain\Utils\Validators\IValidation;
use App\ToDo\Domain\Utils\Validators\RequiredFieldValidation;
use App\ToDo\Domain\Utils\Validators\ValidationComposite;
use App\ToDo\Infrastructure\Repositories\Doctrine\TaskDoctrineRepository;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;

use function DI\autowire;

return [
    CreateTaskUseCase::class => autowire(CreateTaskUseCaseImpl::class),
    CreateTaskPresenter::class => autowire(CreateTaskPresenterImpl::class),
    TaskRepository::class => autowire(TaskDoctrineRepository::class),
    UuidGenerator::class => autowire(RamseyUuidImpl::class),
    IValidation::class => function () {
        $validations[] = new RequiredFieldValidation('description');
        return new ValidationComposite($validations);
    },
    ReadTaskUseCase::class => autowire(ReadTaskUseCaseImpl::class),
    ReadTaskPresenter::class => autowire(ReadTaskPresenterImpl::class),
    UpdateTaskUseCase::class => autowire(UpdateTaskUseCaseImpl::class),
    UpdateTaskPresenter::class => autowire(UpdateTaskPresenterImpl::class),
    DeleteTaskUseCase::class => autowire(DeleteTaskUseCaseImpl::class),
    ListTasksUseCase::class => autowire(ListTasksUseCaseImpl::class),
    ListTaskPresenter::class => autowire(ListTaskPresenterImpl::class),
];

