# User
- Content-Type: application/json
- Endpoint: export HOST=https://dev.frmfm.com/users

## Create users

Method: POST

Request Body Payload

| Property Name        | Type           | Description  |
| -------------        |:---------------:| -----:|
| email                | string       |   Email is required |
| password             | string       |   Password is required |
| bio                  | string       |    Can empty|

Response Payload

| Property Name        | Type           | Description  |
| -------------        |:---------------:| -----:|
| email                | string       | Email is required |
| password             | string       |   Password is required |
| bio                  | string      |    Can empty|

Sample request

``` 
//user.json
{
	"email" : "hello@lackky.com",
	"password": "lackkylove",
	"username": "lackky",
	"firstname" : "Thien",
	"lastname": "Tran"
}
curl -d user.jon -H "Content-Type: application/json" -X POST ${HOST}
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
## Update users

``` 
curl -d '{"fullName" : "Lackky", "bio" : " Iam developer", "phone" : "012345678"}'
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
