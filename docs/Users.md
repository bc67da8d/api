# User
- Content-Type: application/json
- Endpoint: export HOST=https://dev.lackky.com/users

## Create users

Method: POST

Request Body Payload


|Property Name        | Type           | Description  | Default|Required|
|:--------------|:---------|:------:|----|----|
|email | string|The email to create a user |n/a| yes|
|password |string | The password to login |n/a|yes|
|name|string| The name to display profile| n/a|yes|
|bio| string| Introduce yourself| n/a| no|


Sample request

``` 
//user.json
{
	"email" : "hello@lackky.com",
	"password": "lackkylove",
	"name" : "Thien Tran",
}
curl -d user.jon -H "Content-Type: application/json" -X POST ${HOST}
```

Sample response 
```
 {
     "data": {
         "id": 1,
         "name": "Thien Tran",
         "email": "hello@lackky.com",
         "gender": "male",
         "bio" : null,
         "avatar": null,
         "birthday": null,
         "status": 1,
         "createdAt": 1585024996,
         "updatedAt": null
     }
 }
```
## Update users

``` 
curl -d '{"name" : "Lackky", "bio" : " I am CTO"}'
\ -H "Content-Type: application/json" -X PUT ${HOST}
```


## Update avatar
Request Body Payload

| Property Name        | Type           | Description  |
| -------------        |:---------------:| -----:|
| file                | File       |   File is required, only support format image allow |



## Update password

``` 
curl -d '{"password": "lackkylove"}' 
\ -H "Content-Type: application/json" -X PUT ${HOST}/password

```


## Get current users

```
curl -H "Content-Type: application/json" -X GET ${HOST}/me
```

Sample response

``` 
{
     "data": {
         "id": 7,
         "roleId": 5,
         "username": "lasckky",
         "email": "hello@lackky.com",
         "title": null,
         "firstname": "Thien",
         "lastname": "Tran",
         "image": null,
         "cover": null,
         "country": null,
         "zone": null,
         "address": null,
         "zipcode": null,
         "profile": null,
         "bio": null,
         "url": null,
         "amount": null,
         "deposited": null,
         "lastLogin": null,
         "active": null,
         "language": null,
         "specialRoles": null,
         "creationDate": "2019-08-10 08:12:35",
         "modifiedDate": null,
         "activeDate": null,
         "artistNameUrl": null,
         "organizational": null,
         "emailNotification": null,
         "deviceRegistered": null
     }
 }
```
## Get a user by email or username

HOST: `${HOST}/profile/{string}`

string can be: username, email, for example to get user with username:lumicon

```
curl  -X GET ${HOST}/profile/lumicon
-H "Content-Type: application/json" \
-H "Authorization : Bearer eyJ0eXAiOi"
```

Result

``` 
{
    "data": {
        "id": 128,
        "roleId": 4,
        "username": "lumicon",
        "email": "info@holgerlippmann.de",
        "title": null,
        "firstname": "Holger",
        "lastname": "Lippmann",
        "image": "http://cdn.dev.frm.fm/avatar/78acb1a3470b9bd8923af8d517c37a5e.png",
        "cover": null,
        "country": null,
        "zone": null,
        "address": "Berlin, Germany",
        "zipcode": null,
        "profile": null,
        "bio": "www.e-art.co\r\n(b. 1960, Mittweida) lives and works in Wandlitz c/o Berlin\r\n\r\n1985-1990  study for sculpture at the Art Academy, Dresden | diploma\r\n1990-1992  2 years masterstudent with Professor Klaus Schwabe/Art Academy, Dresden\r\n1991  stipend of the County Baden-W&uuml;rttemberg, study at the Art Academy Stuttgart\r\nstipend at &ldquo;l&rsquo;Institut des Hautes Etudes en Art Plastiques &ndash; IHEAP&rdquo;, Paris\r\n1 year residence in Paris\r\n1992  trainee at the Institut of Technology, New York | computer art department\r\n1992-1994  2 year residence in Brooklyn, New York\r\n1997-1998  1 year postgraduate education for multimedia at CIMdata, Berlin\r\nsince 2006  several lectureships at the Art Acadeny Dresden | Media Class\r\n",
        "url": "http://www.e-art.co",
        "amount": 408,
        "deposited": null,
        "lastLogin": "2016-11-12 09:58:35",
        "active": 1,
        "language": "en",
        "specialRoles": 0,
        "creationDate": "2015-09-03 18:20:09",
        "modifiedDate": "2016-11-02 14:03:36",
        "activeDate": "2015-09-03 18:20:09",
        "artistNameUrl": "holger_lippmann",
        "organizational": 0,
        "emailNotification": 1,
        "deviceRegistered": 1
    }
}
```
## Reset password

Use the Password API with the recovery endpoint to send a password recovery email
 (including link and recovery token) to the end user. 

HTTP Request: `GET ${HOST}/users/forgot_password`

```
{
    "email" : "user@lackky.com"
}
curl  -X POST ${HOST}/forgot_password?key=xxx
-H "Content-Type: application/json" \
```
Result response
```
{
    "success": {
        "message": "Notification sent",
        "code": 200,
        "httpCode": 200
    }
}
```

The result of this request is password code random, and automatically included in the email to the end user. The
link something like that
 
```
Hello Thien Tran

You have requested a password reset for the user fcduythien@gmail.com.

Please use this code to reset the password for the Lackky
Here is your code: 456324
If you did not initiate this request, please ignore this email. 

```

Note that the password code random is not part of the response to the API call.

However, the password code random can be used in another POST request to reset the password.

The token is valid exactly once in the 24 hours after it is created. One we have the token 
we can send a POST request

HTTP Request: `POST ${HOST}/users/reset_password`

```
{
    "hash" : "456324"
    "password" : "your new password"
}
```

Then the result:

```
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJcL3VzZXJzXC9yZXNldF9wYXNzd29yZD9rZXk9Njc3YmQzZWI5N2M2NTFiMDNlNjc2NTI5MTQyNzc2Y2MiLCJpYXQiOjE1ODE0MzEwNDksImV4cCI6MTYxMjk2NzA0OSwiZGF0YSI6eyJpZCI6IjEiLCJlbWFpbCI6ImZjZHV5dGhpZW5AZ21haWwuY29tIn19.WEMYIf9Bk7BboM-08dYae74Aeca4crb0XegwtReAJCg",
    "expires": 1612967049
}
```