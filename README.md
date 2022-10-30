# Yii 2 Advanced Project + Admin LTE

Yii 2 Advanced Project with Admin LTE (provided by https://github.com/hail812/yii2-adminlte3)

This environment provides Backoffice and frontend on top of a single docker image (webdevops/php-nginx:8.1-alpine) being served on dedicated ports.

On the contrary of most environments available, this uses the application user inside the app container. This avoids permissions problems derived on running with root as usual. At least on *nix systems.

For production release one should only need to replicate provided Dockerfile and copy application files, enable the Yii environment, run composer for installing packages.


## Usage

A handy Makefile is provided with a set of commands to easy operations

```bash
# Start containers
make up
# wait for MySQL service is ready
# Allow root to connect from the outside
make db_allow_root
# wait for MySQL service is ready
# Install composer packages and activate the docker environment
make init
# Run migrations
make migrate
# Apply data seeds - Fixtures
make seed
```

Interfaces are available at:

Frontoffice http://localhost
Backoffice: http://localhost:8080

Mysql is available at localhost:3306 - Use your favorite client

