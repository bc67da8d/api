# Authentication
- Endpoint: export HOST=https://dev.frmfm.com/auth
- Content-Type: application/json

## Get token

Request Body Payload

| Property Name        | Type           | Description  |
| -------------        |:---------------:| -----:|
| emailOrUsername       | string       |  User or Email is required |
| password             | string       |   Password is required |

Response Payload

| Property Name        | Type           | Description  |
| -------------        |:---------------:| -----:|
| token                | string         | Token is use for app |
| expiresIn            | init           |   Life of token

Sample request

``` 
//user.json
{
	"emailOrUsername" : "hello@lackky.com",
	"password": "lackkylove",
}
curl -d user.json -H "Content-Type: application/json" -X POST ${HOST}
```

Sample response 
```
 {
     "message": "Successful Login",
     "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJcL2F1dGgiLCJpYXQiOjE1NjU0MzAxMzMsImV4cCI6MTU2NTQzMDEzMywiZGF0YSI6eyJpZCI6IjciLCJlbWFpbCI6ImhlbGxvQGxhY2treS5jb20iLCJ1c2VybmFtZSI6Imxhc2Nra3kifX0.lLk3P7wyIVSYFZ4FNml1pT57CZUPF9hiwh3NJCAK2mU",
     "expiresIn": 1565430133
 }
```
