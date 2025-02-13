# Proprli Technical Assessment

This is a test Laravel app for Proprli.

## Setup

1. Clone the repository;


2. Build and start the Docker containers:

   ```bash
   docker-compose up -d --build
   ```

3. Run the setup script inside the container:

   ```bash
   docker exec -it app bash -c "./setup.sh"
   ```

After the setup is completed, the API will be available at:

```
http://localhost/api/
```
Make sure no other services are using port 80.

To access the container's shell:

```
docker exec -it app bash
```

## API Endpoints

The OpenAPI (Swagger) documentation will be available at:

```
http://localhost/docs/api
```
and
```
http://localhost/docs/api.json
```

### `GET /users`

- **Description**: Retrieve a list of users (automatically seeded).

### `GET /buildings`

- **Description**: Retrieve a list of buildings (automatically seeded).

### `GET /buildings/{id}/tasks`

- **Description**: Retrieve a list of tasks, along with their comments, for a specific building.
- **Route Parameters**:
  - `id`: The building ID.
- **Query Parameters**:
  - `start_date` (optional): The start date for filtering tasks by date of creation. **Format**: `YYYY-MM-DD`
  - `end_date` (optional): The end date for filtering tasks by date of creation. **Format**: `YYYY-MM-DD`
  - `assigned_to` (optional): Filter tasks by the assigned user ID.
  - `status` (optional): Filter tasks by status. Possible values: `open`, `in-progress`, `completed`, `rejected`

### `POST /buildings/{id}/tasks`
- **Description**: Create a new task for a specific building.
- **Route Parameters**:
  - `id`: The building ID.
- **Request Body** (JSON):
  - `name`: The name of the task. **Type**: String
  - `description`: A description of the task. **Type**: String
  - `assigned_to`: The ID of the user assigned to the task. **Type**: Integer
  - `status` (optional): The initial status of the task. Possible values: `open`, `in-progress`, `completed`, `rejected`. Default: `open`

### `POST /tasks/{id}/comments`

- **Description**: Create a new comment for a specific task.
- **Route Parameters**:
  - `id`: The task ID.
- **Request Body** (JSON):
  - `content`: The content of the comment. **Type**: String
