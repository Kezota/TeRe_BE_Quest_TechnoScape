# TeRe Backend Quest for TechnoScape 👨‍💻

This project is a Laravel-based backend API created as part of the quest to join the **TechnoScape 2025 TeRe (Teknologi dan Registrasi) Committee**. The goal of this project is to demonstrate backend development skills by implementing user management features using Laravel, including database seeding and consistent API responses.

<br>

## 🚀 Features
- Add new users
- Get all users with pagination
- Get specific user details
- Update user active status
- Factory and Seeder for generating dummy data

## 🛠️ Tech Stack
- **Laravel**: Backend Framework
- **MySQL**: Database
- **Postman/ThunderClient**: API Testing

## 🔧 Installation
To run this project locally, follow these steps:

### 1. Clone the Repository
```bash
git clone https://github.com/Kezota/TeRe_BE_Quest_TechnoScape
```

### 2. Navigate to the Project Directory
```bash
cd TeRe_BE_Quest_TechnoScape
```

### 3. Install Composer Dependencies
Make sure you have [Composer](https://getcomposer.org/) installed, then run:
```bash
composer install
```

### 4. Configure Environment Variables
Copy the `.env.example` file to create a new `.env` file:
```bash
cp .env.example .env
```
Update the `.env` file with your database connection details.

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Run Database Migrations
Migrate the database to create the necessary tables:
```bash
php artisan migrate
```

### 7. Seed the Database
Use the `UserSeeder` class to populate the database with dummy data:
```bash
php artisan db:seed --class=UserSeeder
```

### 8. Start the Development Server
Run the Laravel development server:
```bash
php artisan serve
```

### 9. Test the API
Use tools like Postman or ThunderClient to test the endpoints.

<br>

## 📚 API Endpoints

### 1. Add New User
- **URL**: `/users/add`
- **Method**: `POST`
- **Request Body**:
  ```json
  {
    "email": "userdummy@gmail.com",
    "username": "dummykoboy"
  }
  ```
- **Response**:
  ```json
  {
    "status": 200,
    "msg": "Success Add User",
    "data": null
  }
  ```

---

### 2. Get All Users
- **URL**: `/users`
- **Method**: `GET`
- **Response**:
  ```json
  {
    "status": 200,
    "msg": "Success",
    "data": [
      {
        "id": 0,
        "email": "user0@gmail.com",
        "username": "user123",
        "isActive": false
      }
    ]
  }
  ```

---

### 3. Get Specific User
- **URL**: `/users/:userId`
- **Method**: `GET`
- **Example**: `/users/1`
- **Response**:
  ```json
  {
    "status": 200,
    "msg": "Success",
    "data": {
      "id": 1,
      "email": "user1@gmail.com",
      "username": "user456",
      "isActive": true
    }
  }
  ```

---

### 4. Update User Active Status
- **URL**: `/users/update/active`
- **Method**: `PUT`
- **Request Body**:
  ```json
  {
    "id": 1,
    "isActive": false
  }
  ```
- **Response**:
  ```json
  {
    "status": 200,
    "msg": "Success Update Status",
    "data": null
  }
  ```

---

### 5. Get Users with Pagination (Optional)
- **URL**: `/users/:limit/:page`
- **Method**: `GET`
- **Example**: `/users/5/1`
- **Response**:
  ```json
  {
    "status": 200,
    "msg": "Success",
    "data": {
      "users": [
        {
          "id": 0,
          "email": "user0@gmail.com",
          "username": "user123",
          "isActive": false
        }
      ],
      "max_page": 5,
      "totalData": 25
    }
  }
  ```

## 📝 Notes
- Make sure the database is correctly configured before running migrations and seeders.
- Testing with Postman/ThunderClient ensures that all endpoints meet the required specifications.
