# Base example

## Sign Up

### Create user (John Doe)
    http -j -f post 192.168.99.100:8080/jwt/v1/join \
    username='John Doe' \
    email=john@example.com \
    password=1234567

    HTTP/1.1 201 Created
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Fri, 19 Aug 2016 12:37:34 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 59
    {
        "ok": true
    }

### Create user (repeat)
    http -j -f post 192.168.99.100:8080/jwt/v1/join \
    username='John Doe' \
    email=john@example.com \
    password=1234567

    HTTP/1.1 422 Unprocessable Entity
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Fri, 19 Aug 2016 12:39:49 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 58
    {
        "email": [
            "The email has already been taken."
        ],
        "username": [
            "The username has already been taken."
        ]
    }

### Create user (without args)
    http -j -f post 192.168.99.100:8080/jwt/v1/join

    HTTP/1.1 422 Unprocessable Entity
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Fri, 19 Aug 2016 12:38:50 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 59
    {
        "email": [
            "The email field is required."
        ],
        "password": [
            "The password field is required."
        ],
        "username": [
            "The username field is required."
        ]
    }

### Create user (Judy Doe)
    http -j -f post 192.168.99.100:8080/jwt/v1/join \
    username='Judy Doe' \
    email=judy@example.com \
    password=1234567

    HTTP/1.1 201 Created
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Fri, 19 Aug 2016 12:40:59 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 59
    {
        "ok": true
    }

---

## Sign In

### Login user (John Doe)
    http -j -f post 192.168.99.100:8080/jwt/v1/login \
    username='John Doe' \
    password=1234567

#### Answer
    HTTP/1.1 200 OK
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Fri, 19 Aug 2016 13:17:30 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 59
    {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2p3dFwvdjFcL2xvZ2luIiwiaWF0IjoxNDcxNjEyNjUwLCJleHAiOjE0NzE2MTYyNTAsIm5iZiI6MTQ3MTYxMjY1MCwianRpIjoiNWU1NGZhMjZmN2NhYWNlZTg4OTgzZjQ2NDViYWRjOTIiLCJuYW1lIjpudWxsLCJlbWFpbCI6ImpvaG5AZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6IkpvaG4gRG9lIn0.-2oLChKSlJlRQC_FHZH46aQtvIxpwxCMqrRzgFzAheM"
    }

##### Payload
    {
      "sub": 1,
      "iss": "http://192.168.99.100:8080/jwt/v1/login",
      "iat": 1471612650,
      "exp": 1471616250,
      "nbf": 1471612650,
      "jti": "5e54fa26f7caacee88983f4645badc92",
      "name": null,
      "email": "john@example.com",
      "username": "John Doe"
    }

### Login user (Judy Doe)
    http -j -f post 192.168.99.100:8080/jwt/v1/login \
    username='Judy Doe' \
    password=1234567

#### Answer
    HTTP/1.1 200 OK
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Fri, 19 Aug 2016 13:18:23 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 58
    {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2p3dFwvdjFcL2xvZ2luIiwiaWF0IjoxNDcxNjEyNzAzLCJleHAiOjE0NzE2MTYzMDMsIm5iZiI6MTQ3MTYxMjcwMywianRpIjoiMTk3NmZjZmFlNzY0NGYzYTIyZGIwOGM4MGQ3MzVhM2UiLCJuYW1lIjpudWxsLCJlbWFpbCI6Imp1ZHlAZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6Ikp1ZHkgRG9lIn0.PYQuHIG9IgDHjmJo6Xc4FoRlfROT6N9_8NX-IJJu5Gg"
    }

##### Payload
    {
      "sub": 2,
      "iss": "http://192.168.99.100:8080/jwt/v1/login",
      "iat": 1471612703,
      "exp": 1471616303,
      "nbf": 1471612703,
      "jti": "1976fcfae7644f3a22db08c80d735a3e",
      "name": null,
      "email": "judy@example.com",
      "username": "Judy Doe"
    }

### Login user (Not credentials)
    http -j -f post 192.168.99.100:8080/jwt/v1/login

#### Answer
    HTTP/1.1 422 Unprocessable Entity
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Sun, 14 Aug 2016 08:22:35 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 57
    {
        "password": [
            "The password field is required."
        ],
        "username": [
            "The username field is required."
        ]
    }


---

## Restrict (Authorization: Bearer <token>)

### Token missing
    http -j -f get 192.168.99.100:8080/jwt/v1/user

#### Answer
    HTTP/1.1 400 Bad Request
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Fri, 19 Aug 2016 13:20:50 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 59
    {
        "error": "token_not_provided"
    }

### Token invalid
    http -j -f get 192.168.99.100:8080/jwt/v1/user \
    Authorization:'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2p3dFwvdjFcL2xvZ2luIiwiaWF0IjoxNDcxNjEyNzAzLCJleHAiOjE0NzE2MTYzMDMsIm5iZiI6MTQ3MTYxMjcwMywianRpIjoiMTk3NmZjZmFlNzY0NGYzYTIyZGIwOGM4MGQ3MzVhM2UiLCJuYW1lIjpudWxsLCJlbWFpbCI6Imp1ZHlAZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6Ikp1ZHkgRG9lIn0.PYQuHIG9IgDHjmJo6Xc4FoRlfROT6N9_8NX-IJJu5Gg-XXX'

#### Answer
    HTTP/1.1 400 Bad Request
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Fri, 19 Aug 2016 13:21:53 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 59
    {
        "error": "token_invalid"
    }

### Access allowed
    http -j -f get 192.168.99.100:8080/jwt/v1/user \
    Authorization:'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2p3dFwvdjFcL2xvZ2luIiwiaWF0IjoxNDcxNjEyNzAzLCJleHAiOjE0NzE2MTYzMDMsIm5iZiI6MTQ3MTYxMjcwMywianRpIjoiMTk3NmZjZmFlNzY0NGYzYTIyZGIwOGM4MGQ3MzVhM2UiLCJuYW1lIjpudWxsLCJlbWFpbCI6Imp1ZHlAZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6Ikp1ZHkgRG9lIn0.PYQuHIG9IgDHjmJo6Xc4FoRlfROT6N9_8NX-IJJu5Gg'

#### Answer
    HTTP/1.1 200 OK
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Fri, 19 Aug 2016 13:22:21 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 58
    [
        1,
        2,
        3
    ]
