## Setup Instructions
Prerequisites
PHP >= 8.0
Composer
MySQL or any other compatible database

## Installation Steps

Clone the repository:
git clone `git@github.com:umar122002/UmarKhanLaravel.git`
cd UmarKhanLaravel

Install dependencies:
composer install

Create a .env file: Copy the example .env file:
cp .env.example .env
Configure environment settings: Update your .env file with the correct database settings (e.g., MySQL credentials).

DB_CONNECTION=mysql<br>
DB_HOST=127.0.0.1<br>
DB_PORT=3306<br>
DB_DATABASE=laravel<br>
DB_USERNAME=root<br>
DB_PASSWORD=<br>


Generate an application key: `php artisan key:generate`<br>
Run database migrations: `php artisan migrate`<br>
Run the development server: `php artisan serve`

## API Documentation
### Register a new User
- **Endpoint:** `/api/register`
- **Method:** `POST`
- **Description:** Registers a new user.
#### Request Body:
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password"
}
```
#### Response Body:
```json
{
  "access_token": "your_token_here",
  "token_type": "Bearer"
}
```
### Note: After registration, an access token will be generated. You will need to use this token for all subsequent API requests by passing it in the Authorization header.
### Login User
- **Endpoint:** `/api/login`
- **Method:** `GET`
- **Description:** Logs in a user and returns an access token.
#### Request Body:
```json
{
  "email": "john@example.com",
  "password": "password"
}
```
#### Response Body:
```json
{
  "access_token": "your_token_here",
  "token_type": "Bearer"
}
```
### Note: After login, an access token will be generated. You will need to use this token for all subsequent API requests by passing it in the Authorization header.

### Get all jobs
- **Endpoint:** `/api/jobs`
- **Method:** `GET`
- **Description:** Retrieves all job listings.
#### Response Body:
```json
[
  {
    "id": 1,
    "title": "Software Developer",
    "description": "Develop web applications",
    "company": "Tech Company",
    "location": "New York",
    "salary": 60000
  },
]
```

### Create a new job
- **Endpoint:** `/api/jobs`
- **Method:** `POST`
- **Description:** Create new job listing
 #### Request Body:
```json
{
  "title": "Software Developer",
  "description": "Develop web applications",
  "company": "Tech Company",
  "location": "New York",
  "salary": 60000
}
```
#### Response Body:
```json
{
  "id": 1,
  "title": "Software Developer",
  "description": "Develop web applications",
  "company": "Tech Company",
  "location": "New York",
  "salary": 60000,
  "user_id": 1
}
```

### Get a job by ID
- **Endpoint:** `/api/jobs/{id}`
- **Method:** `GET`
- **Description:** Retrieves a job by its ID.
### Response Body:
```json
{
  "id": 1,
  "title": "Software Developer",
  "description": "Develop web applications",
  "company": "Tech Company",
  "location": "New York",
  "salary": 60000
}
```

### Update a job
- **Endpoint**: `/api/jobs/{id}`
- **Method:** `PUT`
#### Request Body:
```json
{
  "title": "Lead Developer",
  "description": "Lead web development projects"
}
```
#### Response Body:
```json
{
  "id": 1,
  "title": "Lead Developer",
  "description": "Lead web development projects",
  "company": "Tech Company",
  "location": "New York",
  "salary": 60000
}
```

### Delete a job
- **Endpoint:** `/api/jobs/{id}`
- **Method:** `DELETE`
- **Description:** Deletes a job by its ID.
#### Response Body:
```json
{
  "message": "Job deleted successfully",
  "job_id": 1
}
```

### Job Application
- **Endpoint:** `/api/jobs/{id}/apply`
- **Method:** `POST`
- **Description:** Apply for job
- **Request Body:**
```json
{
  "cover_letter": "I am a great fit for this role because..."
}
```
#### Response:
```json
{
  "message": "Application submitted successfully",
  "application": {
    "id": 1,
    "user_id": 1,
    "job_id": 1,
    "status": "pending",
    "cover_letter": "I am a great fit for this role because..."
  }
}
```

### View my job applications
- **Endpoint:** `/api/my-applications`
- **Method:** `GET`
- **Description:** Retrieves the jobs the authenticated user has applied to.
#### Response:
```json
[
  {
    "id": 1,
    "title": "Software Developer",
    "company": "Tech Company",
    "status": "pending",
    "cover_letter": "I am a great fit for this role because..."
  },
]
```

### View job applications for a specific job
- **Endpoint:** `/api/jobs/{id}/applications`
- **Method:** `GET`
- **Description:** Retrieves all applications for a specific job.
#### Response:
```json
{
  "id": 1,
  "title": "Software Developer",
  "applicants": [
    {
      "id": 1,
      "user_id": 2,
      "status": "pending",
      "cover_letter": "I am very interested in this position."
    }
  ]
}
```

## Testing the API
You can test the API using tools like `Postman`
