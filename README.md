## Setup Instructions
Prerequisites
PHP >= 8.0
Composer
MySQL or any other compatible database
Laravel >= 9.52

## Installation Steps

Clone the repository:
git clone git@github.com:umar122002/UmarKhanLaravel.git
cd UmarKhanLaravel

Install dependencies:
composer install

Create a .env file: Copy the example .env file:
cp .env.example .env
Configure environment settings: Update your .env file with the correct database settings (e.g., MySQL credentials).

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=


Generate an application key:
php artisan key:generate

Run database migrations:
php artisan migrate

Run the development server:
php artisan serve

## API Documentation

Endpoints
Jobs Endpoints
Get all jobs

URL: /api/jobs
Method: GET
Description: Retrieves all job listings.
Response:

[
  {
    "id": 1,
    "title": "Software Developer",
    "description": "Develop web applications",
    "company": "Tech Company",
    "location": "New York",
    "salary": 60000
  },
  ...
]


Create a new job

URL: /api/jobs
Method: POST
Request:
Body:
{
  "title": "Software Developer",
  "description": "Develop web applications",
  "company": "Tech Company",
  "location": "New York",
  "salary": 60000
}
Response:
json
{
  "id": 1,
  "title": "Software Developer",
  "description": "Develop web applications",
  "company": "Tech Company",
  "location": "New York",
  "salary": 60000,
  "user_id": 1
}
Get a job by ID

URL: /api/jobs/{id}
Method: GET
Description: Retrieves a job by its ID.
Response:

{
  "id": 1,
  "title": "Software Developer",
  "description": "Develop web applications",
  "company": "Tech Company",
  "location": "New York",
  "salary": 60000
}
Update a job

URL: /api/jobs/{id}
Method: PUT
Request:
Body: (Any field is optional)

{
  "title": "Lead Developer",
  "description": "Lead web development projects"
}
Response:

{
  "id": 1,
  "title": "Lead Developer",
  "description": "Lead web development projects",
  "company": "Tech Company",
  "location": "New York",
  "salary": 60000
}
Delete a job

URL: /api/jobs/{id}
Method: DELETE
Description: Deletes a job by its ID.
Response:

{
  "message": "Job deleted successfully",
  "job_id": 1
}
Job Application Endpoints
Apply for a job

URL: /api/jobs/{id}/apply
Method: POST
Request:
Body: (Optional)

{
  "cover_letter": "I am a great fit for this role because..."
}
Response:

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
View my job applications

URL: /api/my-applications
Method: GET
Description: Retrieves the jobs the authenticated user has applied to.
Response:

[
  {
    "id": 1,
    "title": "Software Developer",
    "company": "Tech Company",
    "status": "pending",
    "cover_letter": "I am a great fit for this role because..."
  },
  ...
]
View job applications for a specific job

URL: /api/jobs/{id}/applications
Method: GET
Description: Retrieves all applications for a specific job.
Response:

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

Testing the API
You can test the API using tools like Postman