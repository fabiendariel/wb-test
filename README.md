# My Web Application

## Description
This web application allows users to register, login, and create invoices. It uses Docker, PHP, MySQL, and Apache.

## Getting Started

### Prerequisites
- Docker
- Docker Compose

### Running the Application

1. Clone the repository:
   ```bash
   git clone https://github.com/fabiendariel/wb-test.git
   cd wb-test

2. Build the Docker container:
  ```docker-compose up --build
  
3. Initialize the database: After the containers are up and running, execute the following command to create the tables:
  ```docker-compose exec web php init.php
  
4. Access the application: Open your web browser and go to http://localhost:8080/index.php.