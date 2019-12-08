# Files
- Content-Type: application/json
- Endpoint: export HOST=https://dev.frmfm.com

## Get All Files

This endpoint retrieves all files. The results returned are paginated.

Method: GET

Special Query Parameters

| Parameter            | Default           | Description  |   Example|
| :-------------        |:---------------:|:-----|---------:|
| page                 | false       |   Return results pertaining to that page | page=3 |
| fields             | false       |   Allows you to return only attributes that you require | fields=artworkId,createdOn,name |
| limit | 10 | The number of results returned per page | limit=50|

Sample request get two item

``` 
curl  -H "Content-Type: application/json" -X GET ${HOST}/uploads?limit=2&page=1

```


## Get a specific file

HTTP Request: `GET ${HOST}/uploads/{id}`

For example to get files with id = 145

```
curl  -X GET ${HOST}/uploads/145
-H "Content-Type: application/json" \
-H "Authorization : Bearer eyJ0eXAiOi"
```

Result:

``` 
{
  "id": 145,
  "key": "thumbnail\/841b030d11b570a4d87b2cd5cb6636a6.jpg",
  "privacy": "public-read",
  "url": "http:\/\/cdn.dev.frm.fm\/thumbnail\/841b030d11b570a4d87b2cd5cb6636a6.jpg",
  "expires": 1569683608,
  "originalFileName": "E899D833-EBD1-454F-B90C-47848E909020.jpg",
  "fileSize": 305956
}
```


## Create an file

|Property Name        | Type           | Description  | Default|Required|
|:--------------|:---------|:------:|----|----|
|file |File | For uploading your artwork file as .ZIP file.|n/a|yes|
|type| string| The type of the attachment. Must be one of the following:file,image|n/a|yes|
|item| string| If you want to upload more than file set it large 1|n/a|no|

Use:

```
curl "${HOST}/uploads?type={$type}&item={$item}" \
    -X POST \
    -F 'file=@/path/to/pictures/picture.jpg'
    -H "Authorization: Bearer 74305f35862b76db" \
    -H "Content-Type: multipart/form-data" \
```

For example upload one image

``` 
curl "${HOST}/uploads?type=image" \
    -X POST \
    -F 'file=@/path/to/pictures/picture.jpg'
    -H "Authorization: Bearer 74305f35862b76db" \
    -H "Content-Type: multipart/form-data" \
```

Result:

```
{
  "id": 1,
  "key": "thumbnail\/841b030d11b570a4d87b2cd5cb6636a6.jpg",
  "privacy": "public-read",
  "url": "http:\/\/cdn.dev.frm.fm\/thumbnail\/841b030d11b570a4d87b2cd5cb6636a6.jpg",
  "expires": 1569683608,
  "originalFileName": "E899D833-EBD1-454F-B90C-47848E909020.jpg",
  "fileSize": 305956
}
```

To upload more then item, you need set parameter item > 1

``` 
curl "${HOST}/uploads?type=image&item=2" \
    -X POST \
    -F 'file=@/path/to/pictures/picture.jpg' \
    -F 'file=@/path/to/pictures/picture2.jpg' \
    -H "Authorization: Bearer 74305f35862b76db" \
    -H "Content-Type: multipart/form-data" \
```

Result:

``` 
[
  {
    "id": 4321,
    "key": "thumbnail\/d9c4f08222c087b668bc8ea9f2632a43.png",
    "privacy": "public-read",
    "url": "http:\/\/cdn.dev.frm.fm\/thumbnail\/d9c4f08222c087b668bc8ea9f2632a43.png",
    "expires": 1569969816,
    "originalFileName": "t-shirt01(1).png",
    "fileSize": 213562
  },
  {
    "id": 4322,
    "key": "thumbnail\/3ee2e0001c7cac130455def0c429c2b3.png",
    "privacy": "public-read",
    "url": "http:\/\/cdn.dev.frm.fm\/thumbnail\/3ee2e0001c7cac130455def0c429c2b3.png",
    "expires": 1569969818,
    "originalFileName": "t-shirt02(1).png",
    "fileSize": 213562
  }
]
```
## Update an file

This endpoint allows you to update a file.

Use any of the attributes listed under the GET request with an ID parameter to specify the artwork you wish to update.

Special Query Parameters

| Parameter   | Description  |   Example|
|:--------------|---------:|------:|
| id | The ID of the resource to delete | id=50|

For example to update a file image:

```
curl "${HOST}/uploads/{id}?type={$type}" \
    -X POST \
    -F 'file=@/path/to/pictures/picture-update.jpg'
    -H "Authorization: Bearer 74305f35862b76db" \
    -H "Content-Type: multipart/form-data" \
```

To update  file or artwork image you need set parameter specify, for example to update a upload image:

``` 
curl "${HOST}/uploads/1?type=image" \
    -X POST \
    -F 'file=@/path/to/pictures/picture.jpg'
    -H "Authorization: Bearer 74305f35862b76db" \
    -H "Content-Type: multipart/form-data" \
```
Result:

``` 
{
  "id": 1,
  "key": "thumbnail\/bdf0f65946b7dfc833b594503216eaa9.jpg",
  "privacy": "public-read",
  "url": "http:\/\/cdn.dev.frm.fm\/thumbnail\/bdf0f65946b7dfc833b594503216eaa9.jpg",
  "expires": 1569683899,
  "originalFileName": "E899D833-EBD1-454F-B90C-47848E909020.jpg",
  "fileSize": 305956
}
```

To update artwork file:

``` 
curl "${HOST}/uploads/1?type=file" \
    -X POST \
    -F 'file=@/path/to/artwork.zip'
    -H "Authorization: Bearer 74305f35862b76db" \
    -H "Content-Type: multipart/form-data" \
```

## Delete a file

This endpoint allows you to delete a resource.

Deleting a resource removes it from all relation table and rate schemes! 
This cannot be undone so be careful

Special Query Parameters

| Parameter   | Description  |   Example|
|:--------------|:---------:|------:|
| id | The ID of the resource to delete | id=50|

A successful delete will return the following JSON:

``` 
{
    "success": {
        "message": "Delete file success",
        "code": 202
    }
}
```

