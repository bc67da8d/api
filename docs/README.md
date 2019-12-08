## Introduction

Welcome to the FRMRM REST API documentation site!

You can use our REST API to access and modify the data within your
FRMFM account. This includes all the information within your artworks, 
feed and invoices that you can use to import / export data or 
create integrations with other systems and software that you use.

### API Access Control Lists (ACL)

Default to get resource from FRMFM you need authentication to get token or use api key, then you
can use resource see [Auth](./Auth)

- API key to use GET request method
- Token key to use when we need POST or PUT, DELETE action 

### Retrieving Records

To retrieve one or more records you should issue a GET request to the relevant endpoint.

You must include an API key with every API request. In the following example, replace YOUR_API_KEY with your API key. 

``` 
curl -X GET https://api.frm.fm/artworks?key=677bd3eb97c651b03e676529142776cc
```
Requesting from the endpoint root (eg /artworks or /feed) will retrieve a paginated list of records.

If you'd like just a single record you can issue an ?id= parameter (eg /artworks?id=1).

Filtering can also be achieved on most endpoints by adding additional fields into the parameter
 string (eg /artworks?id=5&status_id=3&filter_operator=AND).

You can restrict the fields returned by a GET request by issuing a 
list of only the fields you'd like (eg /artworks?id=5&fields=id,name,start,end).

### Creating / Updating a Record

Generally speaking you should issue a POST to create a new record and a PUT to update an existing record.

However the FRM.FM API is quite forgiving and will allow a new record to be created if a PUT is issued without an ID parameter and a POST to update a record if you supply an ID parameter.

It is currently only possible to create or update one record per request.

### Deleting a Record

To delete a record you should issue a DELETE with the ID of the record you wish to delete. Deletion is permanent and cannot be undone.

It is currently only possible to delete one record per request.

### Authentication

Regardless of the authentication method you choose, 
FRM.FM expects the Bearer Authentication Token to be included in all API requests to the server.

You can either include the token in a header that looks like the following:

Authorization: Bearer 74305f35862b76db

Alternatively you can send the token via a query parameter in the URL like the following:

```
https://api.frm.fm/ENDPOINT?access_token=74305f35862b76db
```
If you need some resource do not need authentication by username and password, but you need have
a api key access form FRMFM, contact them to get it once we have you can access like below

``` 
curl -X GET https://api.frm.fm/artworks?key=677bd3eb97c651b03e676529142776cc

```
### Version API

Some API required prefix version api, for example use prefix v1,v2 https://api.frm.fm/v1/artkworks, but I chose method 
API design google keep no prefix version, if you want to defined version we should chose API Gateway like kong gateway,
It will be helper team developer and devops team work better.

In the feature maybe we use Kong Gateway: Its proxy lets you serve multiple versions of the same API 
and provides reporting on how your users are using different versions. 
Working out who’s using an old version can then help you form a strategy to phase out deprecated versions. 