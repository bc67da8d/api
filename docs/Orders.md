# Orders
The Orders API allows you to create, view, update, and delete individual, or a batch, of orders.

- Endpoint: export HOST=https://api.dev.lackky.com
- Content-Type: application/json

## Get All order items
This API helps you to view all the products.

HTTP Request: `GET ${HOST}/orders`

Special Query Parameters

| Parameter       | Default           | Description  |   Example|
| :-------------  |:---------------:|:-----|---------:|
| page            | false       |   Return results pertaining to that page | page=3 |
| fields          | false       |   Allows you to return only attributes that you require | fields=artworkId,createdOn,name |
| limit | 10 | The number of results returned per page | limit=50|

Sample request get two item

``` 
curl  -H "Content-Type: application/json" -X GET ${HOST}/order_items?limit=2&page=1
```

Sample response 


### Get a Specific Artwork

The same people endpoint is used with a filter applied to return only a specific artwork.
We've also specifically requested the fields we need to improve speed and readability.

HTTP Request: `GET ${HOST}/order_items/{id}`

For example to get artwork with id = 145

```
curl  -X GET ${HOST}/artworks/145
-H "Content-Type: application/json" \
-H "Authorization : Bearer eyJ0eXAiOi"
```

Sample response:

## Create a order
This api helps you to create a new order items.

|Property Name        | Type           | Description  | Default|Required|
|:--------------|:---------|:------:|----|----|
|items | array  |Items data. See Order -  Items properties |n/a| yes|
|name | string  |The name order |n/a| no|
|shippingAddress | string  |The shipping address |n/a| no|

Order - Items properties
|Attribute|Type|Description|
|:-----|:-----|:------|
|productId | int  |Product id  |
|quantity | int  |Order quantity |

To get items, you need to call the endpoint `GET ${HOST}/carts` it will be 
return 

``` 
{
	"name: "Order 01",
    "items": [
		{
			"productId" : 1,
			"quantity": 2
		},
		{
			"productId" : 2,
			"quantity": 1
		}
	],
    "customerNote" : "Doi dien KTX DHQG HCM",
    "shippingAddress" : ""
}
```
### Artwork Category table

|Value|Description|
|:---|:----:|
|1|Ambient|
|2|Camera|
|3|Entertainment|
|4|Games|

Same flow above call api endpoint {$HOST}/categories/artwork

#### There are two part to create artwork this design like submit a email form gmail:

- One for upload context with format json
- One for upload media file with format multipart/form-data

First you need create metadata for artwork, Once the metadata is uploaded you get a URL, which allows you to PUT. 
PUT is idempotent so you can retry failed uploads to your hearts content, replacing old attempts as you go.

```
artwork.json
{
    "name" : "Awesome API FRM",
    "artworkCategoryId" : 2,
	"artworkTypeId": 1,
	"price": 100
}
curl "${HOST}/artworks" \
    -X POST \
    -H "Authorization: Bearer 74305f35862b76db" \
    -H "Content-Type: application/json" \
    -d @artwork.json
```
Result:

``` 
{
  "data": {
    "id": 198,
    "artistId": 2109,
    "name": "Awesome API FRM",
    "artistName": "Thien Tran",
    "artworkCategoryId": 2,
    "image": {},
    "imageBgcolor": null,
    "previewImages": {},
    "artworkNameUrl": "awesome-api-frm",
    "isPrivate": 0,
    "status": 0,
    "price": 100,
    "currency": "usd",
    "video": null,
    "videoLink": null,
    "createdOn": "2019-09-18 15:45:31",
    "modifiedOn": "2019-09-18 15:45:31",
    "humanPrice": "$100.00",
    "humanPriceJPY": "¥10,663",
    "users": {
      "data": {
        "id": 2109,
        "roleId": 5,
        "username": "duythien",
        "email": "duythien@lackky.com",
        "title": null,
        "firstname": "Thien",
        "lastname": "Tran",
        "image": {},
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
        "active": 1,
        "language": null,
        "specialRoles": 0,
        "creationDate": "2019-09-05 04:49:57",
        "modifiedDate": null,
        "activeDate": null,
        "artistNameUrl": null,
        "organizational": 0,
        "emailNotification": 1,
        "deviceRegistered": 0
      }
    }
  }
}
```

Then call api upload file, see docs at [./Uploads.md](Uploads.md)

``` 
curl "${HOST}/uploads?type=image" \
    -X POST \
    -F 'image=@/path/to/pictures/picture.jpg'
    -H "Authorization: Bearer 74305f35862b76db" \
    -H "Content-Type: multipart/form-data" \
```
Result: This result to use image, in that case `image=4427`

``` 
{
  "id": 4427,
  "key": "thumbnail\/bdf0f65946b7dfc833b594503216eaa9.jpg",
  "privacy": "public-read",
  "url": "http:\/\/cdn.dev.frm.fm\/thumbnail\/bdf0f65946b7dfc833b594503216eaa9.jpg",
  "expires": 1569683899,
  "originalFileName": "E899D833-EBD1-454F-B90C-47848E909020.jpg",
  "fileSize": 305956
}
```


Upload an artwork file

``` 
curl "${HOST}/uploads?type=file" \
    -X POST \
    -F 'image=@/path/to/artwork.zip'
    -H "Authorization: Bearer 74305f35862b76db" \
    -H "Content-Type: multipart/form-data" \
```

Result: This result to use artworkFile, in that case `artworkFile=4274`

``` 
{
  "id": 4274,
  "key": "artworks\/36969d9c3759c9cc3077124e6d0ce372.zip",
  "privacy": "public-read",
  "url": "http:\/\/cdn.dev.frm.fm\/artworks\/36969d9c3759c9cc3077124e6d0ce372.zip",
  "expires": 1569690613,
  "originalFileName": "artwork-awesome.zip",
  "fileSize": 9166
}
```

To upload preview image item three:

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

Then mobile dev team use that result update again into metadata artwork. Of course mobile dev team can upload file first, then use that result to create metadata artwork.

```
artwork.json
{
    "artworkFile": 4274,
    "image" : 4427,
    "id": 198
}
curl "${HOST}/artworks" \
    -X PUT \
    -H "Authorization: Bearer 74305f35862b76db" \
    -H "Content-Type: application/json" \
    -d @artwork.json
```

Result

``` 
{
  "data": {
    "id": 198,
    "artistId": 2109,
    "name": "Awesome API FRM",
    "artistName": "Thien Tran",
    "artworkCategoryId": 2,
    "image": {
      "id": 4304,
      "key": "thumbnail\/f2ace85fe5f15b98e52b73ea7b30c95c.jpg",
      "privacy": "public-read",
      "url": "http:\/\/cdn.dev.frm.fm\/thumbnail\/f2ace85fe5f15b98e52b73ea7b30c95c.jpg",
      "expires": 1569710712,
      "originalFileName": "photo6055339490458839424.jpg",
      "fileSize": 264540,
      "cdn": "http:\/\/cdn.dev.frm.fm\/thumbnail\/f2ace85fe5f15b98e52b73ea7b30c95c.jpg"
    },
    "imageBgcolor": null,
    "previewImages": {},
    "artworkNameUrl": "awesome-api-frm",
    "isPrivate": 0,
    "status": 0,
    "price": 100,
    "currency": "usd",
    "video": null,
    "videoLink": null,
    "currentVersionId": null,
    "draftVersionId": 213,
    "createdOn": "2019-09-18 15:45:31",
    "modifiedOn": "2019-09-18 16:09:10",
    "humanPrice": "$100.00",
    "humanPriceJPY": "¥10,663",
    "users": {
      "data": {
        "id": 2109,
        "roleId": 5,
        "username": "duythien",
        "email": "duythien@lackky.com",
        "title": null,
        "firstname": "Thien",
        "lastname": "Tran",
        "image": "http:\/\/cdn.dev.frm.fm\/thumbnail\/f2ace85fe5f15b98e52b73ea7b30c95c.jpg",
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
        "active": 1,
        "language": null,
        "specialRoles": 0,
        "creationDate": "2019-09-05 04:49:57",
        "modifiedDate": null,
        "activeDate": null,
        "artistNameUrl": null,
        "organizational": 0,
        "emailNotification": 1,
        "deviceRegistered": 0
      }
    }
  }
}
```

To add preview image to artwork, you need upload first, see above how to work once we have upload success it give array 
then developer mobile team need parser to string id, for example `previewImages='4321,43221'`

```
artwork.json
{
    "artworkFile": 4274,
    "image" : 4427,
    "id": 198,
	"previewImages": "4321,4322"

}
curl "${HOST}/artworks" \
    -X PUT \
    -H "Authorization: Bearer 74305f35862b76db" \
    -H "Content-Type: application/json" \
    -d @artwork.json
```

## Update an artwork

Method: PUT

This endpoint allows you to update a artwork. 
Use any of the attributes listed under the GET request with an ID parameter to specify the artwork you wish to update.

Special Query Parameters

| Parameter   | Description  |   Example|
|:--------------|---------:|------:|
| id | The ID of the resource to delete | id=198|

If we have not set id, in the file json you need set id
```
artwork.json
{
	"name" : "Aweome API FRM update",
	"artworkCategoryId" : 2,
    "id" : 198
}
curl "${HOST}/artworks" \
    -X PUT \
    -H "Authorization: Bearer 74305f35862b76db" \
    -H "Content-Type: application/json" \
    -d @artwork.json
```
Or use option below

```
artwork.json
{
	"name" : "Aweome API FRM update",
	"artworkCategoryId" : 2,
}
curl "${HOST}/artworks/198" \
    -X PUT \
    -H "Authorization: Bearer 74305f35862b76db" \
    -H "Content-Type: application/json" \
    -d @artwork.json
```
Both methods above give the same result

To update artwork file or artwork image, first you need get artwork id, then get field `artworkFile` or `image` this is 
value we need update, for example in this example below image=1 and artworkFile=2

``` 
curl "${HOST}/uploads/1?type=image" \
    -X POST \
    -F 'file=@/path/to/pictures/picture.jpg'
    -H "Authorization: Bearer 74305f35862b76db" \
    -H "Content-Type: multipart/form-data" \
```

To update artwork file:

``` 
curl "${HOST}/uploads/2?type=file" \
    -X POST \
    -F 'file=@/path/to/artwork.zip'
    -H "Authorization: Bearer 74305f35862b76db" \
    -H "Content-Type: multipart/form-data" \
```


## Delete a Artwork

Method: GET

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
        "message": "Delete artwork success",
        "code": 202
    }
}
```

## Get artwork by artistId

Method: GET

URL: `${HOST}?filter[artistId]={int}`

To get all artworks by user(artistId) = 896

```
curl  -X GET ${HOST}?filter[artistId]=896
-H "Content-Type: application/json" \
-H "Authorization : Bearer eyJ0eXAiOi"
```

Sample response

``` {
        "data": [
            {
                "artworkId": 179,
                "artistId": 896,
                "name": "stripe test JPY",
                "artistName": "serena",
                "artworkCategoryId": 1,
                "image": "http://cdn.dev.frm.fm/thumbnail/dade31e99ed3e4bfb10773ddf6b4ed44.png",
                "imageBgcolor": "#18393b",
                "previewImages": null,
                "artworkNameUrl": "stripe_test_jpy",
                "isPrivate": 0,
                "status": 1,
                "price": 1500,
                "currency": "jpy",
                "video": null,
                "videoLink": "https://www.youtube.com/watch?v=1Se-Oh-pe6o",
                "createdOn": null,
                "modifiedOn": "2017-05-29 02:54:58",
                "humanPrice": "$14.06",
                "humanPriceJPY": "¥1,500",
                "users": {
                    "data": {
                        "id": 896,
                        "roleId": 4,
                        "username": "serena",
                        "email": "serena@clash.tw",
                        "title": null,
                        "firstname": null,
                        "lastname": null,
                        "image": {},
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
                        "active": 1,
                        "language": "en",
                        "specialRoles": 0,
                        "creationDate": null,
                        "modifiedDate": null,
                        "activeDate": "2016-11-18 01:27:07",
                        "artistNameUrl": "serena",
                        "organizational": 0,
                        "emailNotification": 1,
                        "deviceRegistered": 1
                    }
                }
            },
            {
                "artworkId": 178,
                "artistId": 896,
                "name": "stripe test USD",
                "artistName": "serena",
                "artworkCategoryId": 1,
                "image": "http://cdn.dev.frm.fm/thumbnail/c43d39cf7d61cdc8f36b5554a6a76b6f.jpg",
                "imageBgcolor": "#7083a0",
                "previewImages": null,
                "artworkNameUrl": "stripe_test_usd",
                "isPrivate": 0,
                "status": 1,
                "price": 15,
                "currency": "usd",
                "video": null,
                "videoLink": "https://www.youtube.com/watch?v=1Se-Oh-pe6o",
                "createdOn": null,
                "modifiedOn": "2017-06-01 14:21:25",
                "humanPrice": "$15.00",
                "humanPriceJPY": "¥1,599",
                "users": {
                    "data": {
                        "id": 896,
                        "roleId": 4,
                        "username": "serena",
                        "email": "serena@clash.tw",
                        "title": null,
                        "firstname": null,
                        "lastname": null,
                        "image": {},
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
                        "active": 1,
                        "language": "en",
                        "specialRoles": 0,
                        "creationDate": null,
                        "modifiedDate": null,
                        "activeDate": "2016-11-18 01:27:07",
                        "artistNameUrl": "serena",
                        "organizational": 0,
                        "emailNotification": 1,
                        "deviceRegistered": 1
                    }
                }
            }
        ],
        "meta": {
            "pagination": {
                "total": 2,
                "count": 1,
                "per_page": 2,
                "current_page": 1,
                "total_pages": 1,
                "links": {}
            }
        }
    }
```