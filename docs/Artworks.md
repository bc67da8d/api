# Artworks

- Endpoint: export HOST=https://dev.frmfm.com
- Content-Type: application/json

## Get All Artworks

This endpoint retrieves all artworks. The results returned are paginated.

Method: GET

Special Query Parameters

| Parameter            | Default           | Description  |   Example|
| :-------------        |:---------------:|:-----|---------:|
| page                 | false       |   Return results pertaining to that page | page=3 |
| fields             | false       |   Allows you to return only attributes that you require | fields=artworkId,createdOn,name |
| limit | 10 | The number of results returned per page | limit=50|

Sample request get two item

``` 

curl  -H "Content-Type: application/json" -X GET ${HOST}/artworks?limit=2&page=1
```

Sample response 
```
{
    "data": [
        {
            "artworkId": 190,
            "artistId": 900,
            "name": "Thien",
            "artistName": "Thien Tran",
            "artworkCategoryId": 1,
            "image": {
                "id": 4269,
                "key": "thumbnail/ae6464d495a88b479293b9e891d74a88.jpg",
                "privacy": "public-read",
                "url": "http://cdn.dev.frm.fm/thumbnail/ae6464d495a88b479293b9e891d74a88.jpg",
                "expires": 1569366444,
                "originalFileName": "46501856_1959017264214616_5531655068199157760_n.jpg",
                "fileSize": 44877,
                "cdn": "http://cdn.dev.frm.fm/thumbnail/ae6464d495a88b479293b9e891d74a88.jpg"
            },
            "imageBgcolor": null,
            "previewImages": {},
            "artworkNameUrl": "thien",
            "isPrivate": 0,
            "status": 1,
            "price": 1001,
            "currency": "usd",
            "video": null,
            "videoLink": null,
            "createdOn": "2019-09-14 16:12:39",
            "modifiedOn": "2019-09-15 14:08:48",
            "humanPrice": "$1,001.00",
            "humanPriceJPY": "¥106,738",
            "users": {
                "data": {
                    "id": 900,
                    "roleId": 5,
                    "username": "lasckky",
                    "email": "hello@lackky.com",
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
                    "creationDate": "2019-08-20 02:10:31",
                    "modifiedDate": null,
                    "activeDate": null,
                    "artistNameUrl": null,
                    "organizational": 0,
                    "emailNotification": 1,
                    "deviceRegistered": 0
                }
            }
        },
        {
            "artworkId": 189,
            "artistId": 900,
            "name": "Test submmit02-update12",
            "artistName": "Thien Tran",
            "artworkCategoryId": 1,
            "image": {
                "id": 4267,
                "key": "thumbnail/ac86d1332a3935fcf3d987eff2594a22.jpg",
                "privacy": "public-read",
                "url": "http://cdn.dev.frm.fm/thumbnail/ac86d1332a3935fcf3d987eff2594a22.jpg",
                "expires": 1569361792,
                "originalFileName": "46501856_1959017264214616_5531655068199157760_n.jpg",
                "fileSize": 44877,
                "cdn": "http://cdn.dev.frm.fm/thumbnail/ac86d1332a3935fcf3d987eff2594a22.jpg"
            },
            "imageBgcolor": null,
            "previewImages": {},
            "artworkNameUrl": "test-submmit02update12",
            "isPrivate": 0,
            "status": 1,
            "price": 1001,
            "currency": "usd",
            "video": null,
            "videoLink": null,
            "createdOn": "2019-09-14 14:20:32",
            "modifiedOn": "2019-09-14 16:12:14",
            "humanPrice": "$1,001.00",
            "humanPriceJPY": "¥106,738",
            "users": {
                "data": {
                    "id": 900,
                    "roleId": 5,
                    "username": "lasckky",
                    "email": "hello@lackky.com",
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
                    "creationDate": "2019-08-20 02:10:31",
                    "modifiedDate": null,
                    "activeDate": null,
                    "artistNameUrl": null,
                    "organizational": 0,
                    "emailNotification": 1,
                    "deviceRegistered": 0
                }
            }
        }
    ],
    "meta": {
        "pagination": {
            "total": 53,
            "count": 27,
            "per_page": 2,
            "current_page": 1,
            "total_pages": 27,
            "links": {
                "next": 2
            }
        }
    }
}
```


### Get a Specific Artwork

The same people endpoint is used with a filter applied to return only a specific artwork.
We've also specifically requested the fields we need to improve speed and readability.

HTTP Request: `GET ${HOST}/artworks/{id}`

For example to get artwork with id = 145

```
curl  -X GET ${HOST}/artworks/145
-H "Content-Type: application/json" \
-H "Authorization : Bearer eyJ0eXAiOi"
```

Sample response

``` 
{
    "data": {
        "artworkId": 145,
        "artistId": 9,
        "name": "fragShaderExample",
        "artistName": "KYND",
        "artworkCategoryId": 1,
        "image": {
            "id": 3549,
            "key": "thumbnail/24ebbf6bbfee3237ae31eafcb2fa8b76.jpg",
            "privacy": "public-read",
            "url": "http://file.frm.fm/thumbnail/24ebbf6bbfee3237ae31eafcb2fa8b76.jpg",
            "expires": 1469437711,
            "originalFileName": "kynd.jpg",
            "fileSize": 162317,
            "cdn": "http://cdn.dev.frm.fm/thumbnail/24ebbf6bbfee3237ae31eafcb2fa8b76.jpg"
        },
        "imageBgcolor": "#7e724c",
        "previewImages": [
            {
                "id": 3551,
                "key": "thumbnail/78756884b082185dc4ecc1e649492bda.jpg",
                "privacy": "public-read",
                "url": "http://file.frm.fm/thumbnail/78756884b082185dc4ecc1e649492bda.jpg",
                "expires": 1469437712,
                "originalFileName": "3eae2506089720aa4155246df9450ea6.jpg",
                "fileSize": 315404,
                "cdn": "http://cdn.dev.frm.fm/thumbnail/78756884b082185dc4ecc1e649492bda.jpg"
            },
            {
                "id": 2370,
                "key": "thumbnail/ff34b6bc593350553fcb5dc5d2804450.png",
                "privacy": "public-read",
                "url": "http://file.frm.fm/thumbnail/ff34b6bc593350553fcb5dc5d2804450.png",
                "expires": 1452637385,
                "originalFileName": "a6c527d593134e78c7e6a29df047a6cd.png",
                "fileSize": 344346,
                "cdn": "http://cdn.dev.frm.fm/thumbnail/ff34b6bc593350553fcb5dc5d2804450.png"
            }
        ],
        "artworkNameUrl": "fragshaderexample",
        "isPrivate": 0,
        "status": 1,
        "price": 1000,
        "currency": "jpy",
        "video": null,
        "videoLink": "https://www.youtube.com/watch?v=1Se-Oh-pe6o",
        "createdOn": null,
        "modifiedOn": "2019-08-24 04:46:06",
        "humanPrice": "$9.37",
        "humanPriceJPY": "¥1,000",
        "users": {
            "data": {
                "id": 9,
                "roleId": 4,
                "username": "filip",
                "email": "filip@fvda.co.uk",
                "title": null,
                "firstname": "Filip",
                "lastname": "Visnjic",
                "image": "http://cdn.dev.frm.fm/avatar/a22d1ff0e7e503aceb4be06e98694791.jpg",
                "cover": 434,
                "country": null,
                "zone": null,
                "address": "London",
                "zipcode": null,
                "profile": null,
                "bio": "Filip Visnjic is an architect, lecturer, curator and a new media technologist born in Belgrade now living in London. He directs new media projects while also contributing to a number of blogs and magazines about art, design and technology. He is an editor-in-chief at CreativeApplications.Net, editorial director at HOLO Magazine, platform director at FRAMED* and he lectures at a number of universities in the UK.",
                "url": "http://fvda.co.uk",
                "amount": 0,
                "deposited": 0,
                "lastLogin": "2017-09-29 11:49:50",
                "active": 1,
                "language": "en",
                "specialRoles": 65536,
                "creationDate": "2015-04-30 13:33:53",
                "modifiedDate": "2016-10-19 13:08:10",
                "activeDate": "2015-07-04 00:00:00",
                "artistNameUrl": "filip_visnjic",
                "organizational": 0,
                "emailNotification": 1,
                "deviceRegistered": 1
            }
        }
    }
}
```
## Create an artwork

|Property Name        | Type           | Description  | Default|Required|
|:--------------|:---------|:------:|----|----|
|image | int|The result id from upload file |n/a| yes|
|artworkFile |int | The result id from upload file |n/a|yes|
|artworkTypeId|int| Only supported artworks types video, gif, exe, etc see value below| n/a|yes|
|name|string| Artwork title|n/a|yes
|currency| string| Chose your pricing currency, currently support only USD and JPY|USD|no|
|price|string| Price for this artwork|n/a|yes|
|numberOfEditions|int|Number of Editions|null| no|
|artistName|string|If you are submitting work on behalf of the artist, can be different from what is set in your artist profile page.|Lastname and firstname current user|no|
|previewImages|string|The list result id from upload file, for example `13,14`|null|no
|previewVideo|string|Currently support url video youtube and video|null|no
|status|int|You can save draft of your artwork before you decide to publish it. DRAFT artworks can be deployed and tested on account holder's FRAMED devices ONLY.|0(set 1 if you want public)|no|
|isPrivate|int|You can set to private mode with value 1, if you want to public set 0|0|no|
|listedInGallery|int|You can set value to 1 if you want this artwork in list gallery|0|no|
|artworkCategoryId|int|You can chose category id below|1|no|
|keywords|string|(comma-separated list of keywords(tags))|null|no|
|delayForVisibility|int|Delay for Visibility|null|no|
|timeoutForLaunching|int|Timeout for Launching|null|no|
|galleryOrder|int|Gallery Order|null|no|
|hardwareAcceleration |int| hardware acceleration |0|no|

Artwork Type table

|Value |Description|
|:---|:----:|
|1| type EXE|
|2| type VVVV|
|4| type VIDEO |
|5| typePROCESSING|
|6| type GIF|
|9| type OPENFRAMEWORKS|

But for mobile app developer  should call endpoint {$HOST}/types/artwork it will be return like above

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