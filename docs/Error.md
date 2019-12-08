## Error
The FRMFM API uses the following error codes:

| Error Code   |      Meaning     | 
|----------|:-------------:|
| 400 |  Bad Request -- The request could not be understood by the server due to malformed syntax. The client SHOULD NOT repeat the request without modifications |
| 401 | Unauthorized -- If the request already included Authorization credentials, then the 401 response indicates that authorization has been refused for those credentials |
| 403 |  Forbidden -- The server understood the request, but is refusing to fulfill it. Authorization will not help and the request SHOULD NOT be repeated|
| 404 |  Not Found -- The server has not found anything matching the Request-URI. |
| 409 |  Conflict -- The request could not be completed due to a conflict with the current state of the resource |
| 429 |  Too Many Requests -- We allow a maximum of 1 request per second |
| 500 |  Internal Server Error -- The server encountered an unexpected condition which prevented it from fulfilling the request |
| 503 |  Service Unavailable -- We're temporarially offline for maintanance. Please try again later. |
