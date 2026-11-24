# Oral Cancer Detection System

## Project Overview
The Oral Cancer Detection System is a web-based academic project designed to support the preliminary identification of potential oral cancer indicators using image processing and machine learning.

The system allows users to upload oral images and receive a prediction from the trained AI model. It also provides a symptom-based assessment option.

**Note:** This project is developed for educational purposes and is not a substitute for professional medical diagnosis.

## Technologies Used
- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **AI / Machine Learning:** Python
- **Database:** MySQL
- **Development Environment:** XAMPP

## Main Features
- User registration and login
- Image upload for AI-based prediction
- Symptom-based assessment
- Prediction result with confidence percentage
- Database storage for prediction records
- Image validation and upload restrictions

## Project Structure

```text
oral-cancer-detection/
│
├── frontend/       # User interface files
├── backend/        # PHP backend and database operations
├── ai_model/       # Python prediction model
├── uploads/        # Uploaded images
└── README.md       # Project documentation
```

## How It Works
1. The user accesses the website.
2. The user uploads an oral image or selects the symptom-based assessment.
3. The backend processes the submitted information.
4. For image-based assessment, the Python AI model generates a prediction.
5. The result is displayed to the user.
6. Prediction details are stored in the MySQL database.

## Installation and Setup

1. Install XAMPP on your computer.
2. Clone