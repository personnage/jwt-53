# ttl 1 min
# refresh ttl 20160

## Create users (Mike and Judy)

    http -j -f post 192.168.99.100:8080/jwt/v1/join \
    username='Mike' \
    email=mike@example.com \
    password=mypassword

    http -j -f post 192.168.99.100:8080/jwt/v1/join \
    username='Judy' \
    email=judy@example.com \
    password=1234567

## Get JSON Web Token expire 1 min.

    http -j -f post 192.168.99.100:8080/jwt/v1/login \
    username='Mike' \
    password=mypassword

    {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2p3dFwvdjFcL2xvZ2luIiwiaWF0IjoxNDcxNjE1NTk1LCJleHAiOjE0NzE2MTU2NTUsIm5iZiI6MTQ3MTYxNTU5NSwianRpIjoiNGYxMWNiNGM2MDY3NWZlNThlZGY5NDQzYmI4MGQwNTkiLCJuYW1lIjpudWxsLCJlbWFpbCI6Im1pa2VAZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6Ik1pa2UifQ.825676_kN-Gi-g90S9BVv0FrwBdz6Gq3ktbgjF0EUtQ"
    }

    // payload
    {
      "sub": 1,
      "iss": "http://192.168.99.100:8080/jwt/v1/login",
      "iat": 1471614557,
      "exp": 1471614617,
      "nbf": 1471614557,
      "jti": "f04c8e0880809912c24987ab4c723dd7",
      "name": null,
      "email": "mike@example.com",
      "username": "Mike"
    }

4) restrict

    http -j -f get 192.168.99.100:8080/jwt/v1/user \
    Authorization:'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2p3dFwvdjFcL2xvZ2luIiwiaWF0IjoxNDcxNjE1NTk1LCJleHAiOjE0NzE2MTU2NTUsIm5iZiI6MTQ3MTYxNTU5NSwianRpIjoiNGYxMWNiNGM2MDY3NWZlNThlZGY5NDQzYmI4MGQwNTkiLCJuYW1lIjpudWxsLCJlbWFpbCI6Im1pa2VAZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6Ik1pa2UifQ.825676_kN-Gi-g90S9BVv0FrwBdz6Gq3ktbgjF0EUtQ'

5) answer

    HTTP/1.1 200 OK
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Fri, 19 Aug 2016 13:49:28 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 58
    {
        "created_at": "2016-08-19 13:47:39",
        "current_sign_in_at": null,
        "current_sign_in_ip": null,
        "deleted_at": null,
        "email": "mike@example.com",
        "failed_attempts": 0,
        "id": 1,
        "last_sign_in_at": null,
        "last_sign_in_ip": null,
        "name": null,
        "sign_in_count": 0,
        "updated_at": "2016-08-19 13:47:39",
        "username": "Mike"
    }

6) Get payload

    http -j -f get 192.168.99.100:8080/jwt/v1/token/payload \
    Authorization:'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2p3dFwvdjFcL2xvZ2luIiwiaWF0IjoxNDcxNjE1NTk1LCJleHAiOjE0NzE2MTU2NTUsIm5iZiI6MTQ3MTYxNTU5NSwianRpIjoiNGYxMWNiNGM2MDY3NWZlNThlZGY5NDQzYmI4MGQwNTkiLCJuYW1lIjpudWxsLCJlbWFpbCI6Im1pa2VAZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6Ik1pa2UifQ.825676_kN-Gi-g90S9BVv0FrwBdz6Gq3ktbgjF0EUtQ'

6) Wait 1 min

7) repeat restrict

    http -j -f get 192.168.99.100:8080/jwt/v1/user \
    Authorization:'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2p3dFwvdjFcL2xvZ2luIiwiaWF0IjoxNDcxNjE1NTk1LCJleHAiOjE0NzE2MTU2NTUsIm5iZiI6MTQ3MTYxNTU5NSwianRpIjoiNGYxMWNiNGM2MDY3NWZlNThlZGY5NDQzYmI4MGQwNTkiLCJuYW1lIjpudWxsLCJlbWFpbCI6Im1pa2VAZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6Ik1pa2UifQ.825676_kN-Gi-g90S9BVv0FrwBdz6Gq3ktbgjF0EUtQ'

8) answer

    HTTP/1.1 401 Unauthorized
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Fri, 19 Aug 2016 13:51:13 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 59
    {
        "error": "token_expired"
    }


9) refresh token

    http -j -f post 192.168.99.100:8080/jwt/v1/token/refresh \
    Authorization:'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2p3dFwvdjFcL2xvZ2luIiwiaWF0IjoxNDcxNjE1NTk1LCJleHAiOjE0NzE2MTU2NTUsIm5iZiI6MTQ3MTYxNTU5NSwianRpIjoiNGYxMWNiNGM2MDY3NWZlNThlZGY5NDQzYmI4MGQwNTkiLCJuYW1lIjpudWxsLCJlbWFpbCI6Im1pa2VAZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6Ik1pa2UifQ.825676_kN-Gi-g90S9BVv0FrwBdz6Gq3ktbgjF0EUtQ'

    HTTP/1.1 200 OK
    Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2p3dFwvdjFcL3Rva2VuXC9yZWZyZXNoIiwiaWF0IjoxNDcxNjE1NTk1LCJleHAiOjE0NzE2MTU3NTgsIm5iZiI6MTQ3MTYxNTY5OCwianRpIjoiN2Y2NDViMzkzNGE3MWMyMTU1M2IxZmEwODc2N2U2YWIiLCJuYW1lIjpudWxsLCJlbWFpbCI6Im1pa2VAZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6Ik1pa2UifQ.MIoGXRWZ-E-AaeJad2xDX9sTQ4d-wMV6y7PKFntbfio
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Fri, 19 Aug 2016 14:08:18 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 58
    {
        "ok": true
    }


10) payload
{
  "sub": 1,
  "iss": "http://192.168.99.100:8080/api/v1/refresh",
  "iat": 1471169076,  Sun, 14 Aug 2016 10:04:36 GMT
  "exp": 1471169245,  Sun, 14 Aug 2016 10:07:25 GMT
  "nbf": 1471169185,  Sun, 14 Aug 2016 10:06:25 GMT
  "jti": "61cc5a1e2f9f606f5453474f246e43d0",
  "name": null,
  "email": "john@example.com",
  "username": "John Doe"
}

11) restrict (new token)

    http -j -f get 192.168.99.100:8080/jwt/v1/user \
    Authorization:'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cLzE5Mi4xNjguOTkuMTAwOjgwODBcL2p3dFwvdjFcL3Rva2VuXC9yZWZyZXNoIiwiaWF0IjoxNDcxNjE1NTk1LCJleHAiOjE0NzE2MTU3NTgsIm5iZiI6MTQ3MTYxNTY5OCwianRpIjoiN2Y2NDViMzkzNGE3MWMyMTU1M2IxZmEwODc2N2U2YWIiLCJuYW1lIjpudWxsLCJlbWFpbCI6Im1pa2VAZXhhbXBsZS5jb20iLCJ1c2VybmFtZSI6Ik1pa2UifQ.MIoGXRWZ-E-AaeJad2xDX9sTQ4d-wMV6y7PKFntbfio'

12) asnwer

    HTTP/1.1 200 OK
    Cache-Control: no-cache
    Connection: close
    Content-Type: application/json
    Date: Sun, 14 Aug 2016 10:06:55 GMT
    Host: 192.168.99.100:8080
    X-Powered-By: PHP/7.0.9
    X-RateLimit-Limit: 60
    X-RateLimit-Remaining: 57
    {
        "created_at": "2016-08-14 10:04:31",
        "current_sign_in_at": "2016-08-14 10:04:36",
        "current_sign_in_ip": "192.168.99.1",
        "deleted_at": null,
        "email": "john@example.com",
        "failed_attempts": 0,
        "id": 1,
        "last_sign_in_at": null,
        "last_sign_in_ip": null,
        "name": null,
        "sign_in_count": 1,
        "updated_at": "2016-08-14 10:04:36",
        "username": "John Doe"
    }
