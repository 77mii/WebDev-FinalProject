.PHONY: help up down build restart logs shell migrate seed fresh node queue

help: ## Show this help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-15s\033[0m %s\n", $$1, $$2}'

build: ## Build all containers
	docker compose build

up: ## Start all containers
	docker compose up -d

up-dev: ## Start all containers including dev services (node, queue worker)
	docker compose --profile dev up -d

down: ## Stop all containers
	docker compose --profile dev down

restart: ## Restart all containers
	docker compose --profile dev down
	docker compose --profile dev up -d

logs: ## View container logs
	docker compose logs -f

logs-app: ## View app container logs
	docker compose logs -f app

shell: ## Open a bash shell in the app container
	docker compose exec app bash

migrate: ## Run database migrations
	docker compose exec app php artisan migrate

seed: ## Run database seeders
	docker compose exec app php artisan db:seed

fresh: ## Fresh migration + seed
	docker compose exec app php artisan migrate:fresh --seed

node: ## Start Vite dev server (via node container)
	docker compose --profile dev up -d node

queue: ## Start queue worker
	docker compose --profile dev up -d queue

composer-install: ## Install PHP dependencies
	docker compose exec app composer install

npm-install: ## Install Node dependencies
	docker compose exec node npm install

npm-build: ## Build frontend assets for production
	docker compose run --rm node sh -c "npm install && npm run build"

artisan: ## Run artisan command (usage: make artisan cmd="your:command")
	docker compose exec app php artisan $(cmd)

mysql: ## Open MySQL CLI
	docker compose exec mysql mysql -u laravel -psecret laravel

tinker: ## Open Laravel Tinker
	docker compose exec app php artisan tinker
