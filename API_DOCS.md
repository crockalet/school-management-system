# School Management System API Documentation

## Overview

The School Management System API provides endpoints to manage students, teachers, classes, subjects, and administrative tasks. It is designed for use by school staff, administrators, and integrated client applications.

---

## Authentication

All endpoints require authentication via JWT tokens. Include the token in the `Authorization` header:

```
Authorization: Bearer <token>
```

---

## Endpoints

### Authentication

<details>
  <summary>POST <code>/auth/login</code> <code>Login</code></summary>

#### Body

```json
{
    "email": "string",
    "password": "string"
}
```

#### Response

```json
{
    "message": "string",
    "token": "string"
}
```

</details>

### Students

<details>
  <summary>GET <code>/students</code> <code>List all students</code></summary>

Paginated list of students.

#### Response

```json
{
    "data": [
        {
            "id": "integer",
            "name": "string",
            "email": "string",
            "grade": "string"
        }
    ]
}
```

</details>

<details>
  <summary>POST <code>/students</code> <code>Create a new student</code></summary>

Create a new student.

#### Body

```json
{
    "id": "integer",
    "name": "string",
    "email": "string",
    "grade": "string"
}
```

#### Response

```json
{
    "data": {
        "id": "integer",
        "name": "string",
        "email": "string",
        "grade": "string"
    }
}
```

</details>

<details>
  <summary>GET <code>/students/{student_id}</code> <code>Get a student</code></summary>

Get details of a specific student.

#### Parameters

> | name       | type             |
> | ---------- | ---------------- |
> | student_id | integer,required |

#### Response

```json
{
    "data": {
        "id": "integer",
        "name": "string",
        "email": "string",
        "grade": "string"
    }
}
```

</details>

<details>
  <summary>PUT <code>/students/{student_id}</code> <code>Update a student</code></summary>

Update student details.

#### Parameters

> | name       | type             |
> | ---------- | ---------------- |
> | student_id | integer,required |

#### Body

```json
{
    "name": "string",
    "email": "string",
    "grade": "string"
}
```

#### Response

```json
{
    "data": {
        "id": "integer",
        "name": "string",
        "email": "string",
        "grade": "string"
    }
}
```

</details>

<details>
  <summary>DELETE <code>/students/{student_id}</code></summary>

Remove a student.

#### Parameters

> | name       | type             |
> | ---------- | ---------------- |
> | student_id | integer,required |

#### Response

```json
{
    "message": "Student deleted successfully"
}
```

</details>

---

### Classes

<details>
  <summary>GET <code>/classes</code> <code>List all classes</code></summary>

Paginated list of classes.

#### Response

```json
{
    "data": [
        {
            "id": "integer",
            "name": "string",
            "max_students": "integer",
            "students_count": "integer"
        }
    ]
}
```

</details>

<details>
  <summary>GET <code>/classes/{class_id}</code> <code>Get class details</code></summary>

Get details of a specific class.

#### Parameters

> | name     | type             |
> | -------- | ---------------- |
> | class_id | integer,required |

#### Response

```json
{
    "data": {
        "id": "integer",
        "name": "string",
        "max_students": "integer",
        "students": [
            {
                "id": "integer",
                "name": "string",
                "email": "string",
                "grade": "string"
            }
        ]
    }
}
```

</details>

<details>
  <summary>POST <code>/classes</code> <code>Create a new class</code></summary>

Create a new class.

#### Body

```json
{
    "name": "string",
    "section": "string",
    "max_students": "integer",
    "students": "array<integer> optional"
}
```

#### Response

```json
{
    "data": {
        "id": "integer",
        "name": "string",
        "max_students": "integer"
    }
}
```

</details>

<details>
  <summary>PUT <code>/classes/{class_id}</code> <code>Update class information</code></summary>

Update class information.

#### Parameters

> | name     | type             |
> | -------- | ---------------- |
> | class_id | integer,required |

#### Body

```json
{
    "name": "string",
    "section": "string",
    "max_students": "integer"
}
```

#### Response

```json
{
    "data": {
        "id": "integer",
        "name": "string",
        "max_students": "integer"
    }
}
```

</details>

<details>
  <summary>DELETE <code>/classes/{class_id}</code></summary>

Remove a class.

#### Parameters

> | name     | type             |
> | -------- | ---------------- |
> | class_id | integer,required |

#### Response

```json
{
    "message": "Class deleted successfully"
}
```

</details>

<details>
  <summary>POST <code>/classes/{class_id}/students/assign</code> <code>Add students to class</code></summary>

Add students to a class.

#### Body

```json
{
    "students": ["integer"]
}
```

#### Response

```json
{
    "message": "Students added to class successfully",
    "students": [
        {
            "id": "integer",
            "name": "string",
            "email": "string",
            "grade": "string"
        }
    ]
}
```

</details>

<details>
  <summary>POST <code>/classes/{class_id}/students/unassign</code> <code>Remove students from class</code></summary>

Remove students from a class.

#### Body

```json
{
    "students": ["integer"]
}
```

#### Response

```json
{
    "message": "Students removed from class successfully",
    "students": [
        {
            "id": "integer",
            "name": "string",
            "email": "string",
            "grade": "string"
        }
    ]
}
```

</details>

## Error Handling

All errors return a JSON response with an `error` field and appropriate HTTP status code.

---
