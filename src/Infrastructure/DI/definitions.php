<?php

use App\ToDo\Application\Presenters\CreateTask\CreateTaskPresenter;
use App\ToDo\Application\Presenters\CreateTask\CreateTaskPresenterImpl;
use App\ToDo\Application\Presenters\ListTask\ListTaskPresenter;
use App\ToDo\Application\Presenters\ListTask\ListTaskPresenterImpl;
use App\ToDo\Application\Presenters\ReadTask\ReadTaskPresenter;
use App\ToDo\Application\Presenters\ReadTask\ReadTaskPresenterImpl;
use App\ToDo\Application\Presenters\UpdateTask\UpdateTaskPresenter;
use App\ToDo\Application\Presenters\UpdateTask\UpdateTaskPresenterImpl;
use App\ToDo\Domain\Protocols\TaskListRepository;
use App\ToDo\Domain\Protocols\TaskRepository;
use App\ToDo\Domain\Protocols\UuidGenerator;
use App\ToDo\Domain\UseCases\CreateList\CreateTaskListUseCase;
use App\ToDo\Domain\UseCases\CreateList\CreateTaskListUseCaseImpl;
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
use App\ToDo\Infrastructure\Repositories\Doctrine\TaskListDoctrineRepository;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;

use function DI\autowire;

return [
    // Factories
    IValidation::class           => function () {
        $validations[] = new RequiredFieldValidation('description');
        return new ValidationComposite($validations);
    },

    // Services
    UuidGenerator::class         => autowire(RamseyUuidImpl::class),
    CreateTaskUseCase::class     => autowire(CreateTaskUseCaseImpl::class),
    ReadTaskUseCase::class       => autowire(ReadTaskUseCaseImpl::class),
    UpdateTaskUseCase::class     => autowire(UpdateTaskUseCaseImpl::class),
    DeleteTaskUseCase::class     => autowire(DeleteTaskUseCaseImpl::class),
    ListTasksUseCase::class      => autowire(ListTasksUseCaseImpl::class),
    CreateTaskListUseCase::class => autowire(CreateTaskListUseCaseImpl::class),

    // Presenters
    CreateTaskPresenter::class   => autowire(CreateTaskPresenterImpl::class),
    ReadTaskPresenter::class     => autowire(ReadTaskPresenterImpl::class),
    UpdateTaskPresenter::class   => autowire(UpdateTaskPresenterImpl::class),
    ListTaskPresenter::class     => autowire(ListTaskPresenterImpl::class),

    // Repositories
    TaskRepository::class        => autowire(TaskDoctrineRepository::class),
    TaskListRepository::class    => autowire(TaskListDoctrineRepository::class),
];

