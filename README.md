# Tasks List with Clean Architecture in PHP

## Introduction
This project was created with intuit of aggregate more knowledge in my portfolio.

## About the project
The Tasks List project has 4 functionalities, all them covered by tests using PHPUnit:

Functionalities:
- Create
- Find
- Update
- Delete 

Stack
- Language: PHP
- Framework of tests: PHPUnit
- Slim Framework in external layer

## How to this project is structured
<p align="center">
  <img src="docs\structure.png"/>
  <label>*This image may be out of date</label>
</p>

## How to run

Clone the project:
```
git clone https://github.com/anglesson/task-clean-architecture.git
```

Change directory:
```
cd task-clean-architecture/
```

Create `.env` file:
```
cp .env.example .env
```

Run composer:
```
docker compose up
```

OR


```
docker-compose up
```

Your app is running on http://localhost:8080

Import API Collection for your Postman. You can find on `docs/tca-api-collection.postman_collection`
