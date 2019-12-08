# Feeds

- Endpoint: export HOST=https://api.dev.frm.fm
- Content-Type: application/json

## Get All Feeds

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

curl  -H "Content-Type: application/json" -X GET ${HOST}/feeds?limit=2&page=1
```

Sample response:

``` 
{
  "data": [
    {
      "id": 33,
      "url": "https:\/\/vimeo.com\/122657704",
      "thumb": {
        "id": 280,
        "key": "feedthumbnail\/c6df375ffc6f37ad60a65acf9e0ae385.jpg",
        "privacy": "public-read",
        "url": "http:\/\/file.frm.fm\/feedthumbnail\/c6df375ffc6f37ad60a65acf9e0ae385.jpg",
        "expires": 1437458115,
        "originalFileName": "c6df375ffc6f37ad60a65acf9e0ae385.jpg",
        "fileSize": null,
        "cdn": "http:\/\/cdn.dev.frm.fm\/feedthumbnail\/c6df375ffc6f37ad60a65acf9e0ae385.jpg"
      },
      "name": "Xbox ~ Motion Brand Identity",
      "createdOn": "2015-07-21 05:55:15",
      "updatedOn": "2016-09-14 09:16:15",
      "thumbWidth": 640,
      "thumbHeight": 360,
      "tags": "xbox#motion#identity#Microsoft#branding#design#graphic",
      "userFollowing": {
        "data": [
          {
            "id": 32,
            "roleId": 5,
            "username": "Afxkuo",
            "email": "Afxkuo@gmail.com",
            "title": null,
            "firstname": "Afx",
            "lastname": "Kuo",
            "image": "http:\/\/cdn.dev.frm.fm\/avatar\/13bc47215ed0d6993487983d8692f82e.jpg",
            "cover": null,
            "country": null,
            "zone": null,
            "address": "Taipei",
            "zipcode": null,
            "profile": null,
            "bio": null,
            "url": null,
            "amount": 0,
            "deposited": 0,
            "lastLogin": "2015-07-17 13:34:44",
            "active": 1,
            "language": null,
            "specialRoles": 0,
            "creationDate": "2015-07-17 13:34:44",
            "modifiedDate": "2015-07-17 14:40:23",
            "activeDate": "2015-07-04 00:00:00",
            "artistNameUrl": null,
            "organizational": 0,
            "emailNotification": 1,
            "deviceRegistered": 1
          }
        ]
      }
    },
    {
      "id": 34,
      "url": "https:\/\/drive.google.com\/file\/d\/0ByE6kuEye9gQcUs3eU1qZS1pdnc\/view?usp=sharing",
      "thumb": {
        "id": 281,
        "key": "feedthumbnail\/ebff55db648fa295093559de72964260.PNG",
        "privacy": "public-read",
        "url": "http:\/\/file.frm.fm\/feedthumbnail\/ebff55db648fa295093559de72964260.PNG",
        "expires": 1437458358,
        "originalFileName": "PNG.PNG",
        "fileSize": null,
        "cdn": "http:\/\/cdn.dev.frm.fm\/feedthumbnail\/ebff55db648fa295093559de72964260.PNG"
      },
      "name": "all-HD-new-no logo.mp4 - Google Drive",
      "createdOn": "2015-07-21 05:59:18",
      "updatedOn": "2016-09-14 09:16:15",
      "thumbWidth": 190,
      "thumbHeight": 338,
      "tags": "",
      "userFollowing": {
        "data": [
          {
            "id": 32,
            "roleId": 5,
            "username": "Afxkuo",
            "email": "Afxkuo@gmail.com",
            "title": null,
            "firstname": "Afx",
            "lastname": "Kuo",
            "image": "http:\/\/cdn.dev.frm.fm\/avatar\/13bc47215ed0d6993487983d8692f82e.jpg",
            "cover": null,
            "country": null,
            "zone": null,
            "address": "Taipei",
            "zipcode": null,
            "profile": null,
            "bio": null,
            "url": null,
            "amount": 0,
            "deposited": 0,
            "lastLogin": "2015-07-17 13:34:44",
            "active": 1,
            "language": null,
            "specialRoles": 0,
            "creationDate": "2015-07-17 13:34:44",
            "modifiedDate": "2015-07-17 14:40:23",
            "activeDate": "2015-07-04 00:00:00",
            "artistNameUrl": null,
            "organizational": 0,
            "emailNotification": 1,
            "deviceRegistered": 1
          }
        ]
      }
    }
  ],
  "meta": {
    "pagination": {
      "total": 2108,
      "count": 1054,
      "per_page": 2,
      "current_page": 1,
      "total_pages": 1054,
      "links": {
        "next": 2
      }
    }
  }
}
```

## Get Feeds by User

This endpoint retrieves all feeds by username or user id. The results returned are paginated.

HTTP Request: 

`GET ${HOST}/feeds/user/{user}`

Special Query Parameters

| Parameter            | Default           | Description  |   Example|
| :-------------        |:---------------:|:-----|---------:|
| user                 | false       |   User can be username or user id | eric |
| page                 | false       |   Return results pertaining to that page | page=3 |
| fields             | false       |   Allows you to return only attributes that you require | fields=artworkId,createdOn,name |
| limit | 10 | The number of results returned per page | limit=50|

Sample request get two item with user `eric`

``` 
curl  -H "Content-Type: application/json" -X GET ${HOST}/feeds/eric?limit=2&page=1
```

Sample response:

``` 
{
  "data": [
    {
      "id": 118,
      "url": "https:\/\/vimeo.com\/117162623",
      "thumb": {
        "id": 406,
        "key": "feedthumbnail\/a43971a38d8384a4203af0ce85928f36.jpg",
        "privacy": "public-read",
        "url": "http:\/\/file.frm.fm\/feedthumbnail\/a43971a38d8384a4203af0ce85928f36.jpg",
        "expires": 1437604719,
        "originalFileName": "13f11a6363fde7a9f317992eb0491ec7.jpg",
        "fileSize": null,
        "cdn": "http:\/\/cdn.dev.frm.fm\/feedthumbnail\/a43971a38d8384a4203af0ce85928f36.jpg"
      },
      "name": "[BRDG020] Lilium",
      "createdOn": "2015-07-22 22:38:39",
      "updatedOn": "2016-09-14 09:16:30",
      "thumbWidth": 640,
      "thumbHeight": 360,
      "tags": "BRDG#Tokyo#Japan#Audio Visual#openframeworks#kynd#yaporigami#generative#openGL#FBO",
      "userFollowing": {
        "data": [
          {
            "id": 6,
            "roleId": 4,
            "username": "eric",
            "email": "eric.chou127@gmail.com",
            "title": null,
            "firstname": "Eric",
            "lastname": "Chou",
            "image": {},
            "cover": 4194,
            "country": null,
            "zone": null,
            "address": null,
            "zipcode": null,
            "profile": null,
            "bio": null,
            "url": null,
            "amount": 3.4,
            "deposited": 0,
            "lastLogin": "2018-06-18 17:06:15",
            "active": 1,
            "language": "en",
            "specialRoles": 16777215,
            "creationDate": "2015-04-17 09:39:11",
            "modifiedDate": "2017-07-03 16:08:14",
            "activeDate": "2015-07-04 00:00:00",
            "artistNameUrl": "eric_chou_1",
            "organizational": 0,
            "emailNotification": null,
            "deviceRegistered": 1
          },
          {
            "id": 8,
            "roleId": 4,
            "username": "williamxlai",
            "email": "will@frm.fm",
            "title": null,
            "firstname": null,
            "lastname": null,
            "image": "http:\/\/cdn.dev.frm.fm\/avatar\/e7c47c379c7ed6a879e67fec50923d62.png",
            "cover": 645,
            "country": null,
            "zone": null,
            "address": null,
            "zipcode": null,
            "profile": null,
            "bio": "William is the co-founder of FRM, where he guides product and overall strategy of FRAMED ー a publishing platform for screen-based artworks. William&rsquo;s work spans across product design and user experience, with a focus on physical products combined with the collaborative nature of the web. Prior to creating digital products, William successfully founded and operated TempleATS, an independent music label in Tokyo, where he found his first passion; produced and released five albums with award-winning group, Origami; and winner of the Golden Melody Award in 2004 for his production on Shawn Sung&rsquo;s solo release, Life&rsquo;s a Struggle.",
            "url": "http:\/\/frm.fm",
            "amount": 2.04,
            "deposited": 0,
            "lastLogin": "2017-10-06 08:30:55",
            "active": 1,
            "language": "ja",
            "specialRoles": 786432,
            "creationDate": "2015-04-28 06:57:46",
            "modifiedDate": "2017-05-29 10:19:31",
            "activeDate": "2015-07-04 00:00:00",
            "artistNameUrl": "williamxlai",
            "organizational": 0,
            "emailNotification": 1,
            "deviceRegistered": 1
          },
          {
            "id": 13,
            "roleId": 5,
            "username": "stephen",
            "email": "stephen.royal@footprintreps.com",
            "title": null,
            "firstname": "Stephen",
            "lastname": "Royal",
            "image": "http:\/\/cdn.dev.frm.fm\/avatar\/94702b6b34930cbef14ffd6cb6b94e38.png",
            "cover": null,
            "country": null,
            "zone": null,
            "address": "Chicago, IL",
            "zipcode": null,
            "profile": null,
            "bio": null,
            "url": "http:\/\/footprintreps.com",
            "amount": 0,
            "deposited": 0,
            "lastLogin": "2016-11-23 16:28:40",
            "active": 1,
            "language": null,
            "specialRoles": 0,
            "creationDate": "2015-05-18 15:44:17",
            "modifiedDate": "2015-05-18 17:29:43",
            "activeDate": "2015-07-04 00:00:00",
            "artistNameUrl": null,
            "organizational": 0,
            "emailNotification": 1,
            "deviceRegistered": 1
          }
        ]
      }
    },
    {
      "id": 267,
      "url": "http:\/\/www.teslamotors.com\/",
      "thumb": {
        "id": 737,
        "key": "feedthumbnail\/4732a5e939df739ed565da1c9d1aef1d.PNG",
        "privacy": "public-read",
        "url": "http:\/\/file.frm.fm\/feedthumbnail\/4732a5e939df739ed565da1c9d1aef1d.PNG",
        "expires": 1438927067,
        "originalFileName": "PNG.PNG",
        "fileSize": null,
        "cdn": "http:\/\/cdn.dev.frm.fm\/feedthumbnail\/4732a5e939df739ed565da1c9d1aef1d.PNG"
      },
      "name": "Tesla Motors | Premium Electric Vehicles",
      "createdOn": "2015-08-07 05:57:47",
      "updatedOn": "2016-09-14 09:16:59",
      "thumbWidth": 600,
      "thumbHeight": 450,
      "tags": "",
      "userFollowing": {
        "data": [
          {
            "id": 6,
            "roleId": 4,
            "username": "eric",
            "email": "eric.chou127@gmail.com",
            "title": null,
            "firstname": "Eric",
            "lastname": "Chou",
            "image": {},
            "cover": 4194,
            "country": null,
            "zone": null,
            "address": null,
            "zipcode": null,
            "profile": null,
            "bio": null,
            "url": null,
            "amount": 3.4,
            "deposited": 0,
            "lastLogin": "2018-06-18 17:06:15",
            "active": 1,
            "language": "en",
            "specialRoles": 16777215,
            "creationDate": "2015-04-17 09:39:11",
            "modifiedDate": "2017-07-03 16:08:14",
            "activeDate": "2015-07-04 00:00:00",
            "artistNameUrl": "eric_chou_1",
            "organizational": 0,
            "emailNotification": null,
            "deviceRegistered": 1
          }
        ]
      }
    }
  ],
  "meta": {
    "pagination": {
      "total": 32,
      "count": 16,
      "per_page": 2,
      "current_page": 1,
      "total_pages": 16,
      "links": {
        "next": 2
      }
    }
  }
}
```

### Get a Specific Feed

The same people endpoint is used with a filter applied to return only a specific artwork.
We've also specifically requested the fields we need to improve speed and readability.

HTTP Request: `GET ${HOST}/feeds/{id}`

For example to get artwork with id = 268

```
curl  -X GET ${HOST}/feeds/268
-H "Content-Type: application/json" \
-H "Authorization : Bearer eyJ0eXAiOi"
```

Sample response

```
{
  "data": {
    "id": 268,
    "url": "http:\/\/infinite-sunset.com",
    "thumb": {
      "id": 738,
      "key": "feedthumbnail\/d422b63c1f7c40984b46c3be627dce9a.PNG",
      "privacy": "public-read",
      "url": "http:\/\/file.frm.fm\/feedthumbnail\/d422b63c1f7c40984b46c3be627dce9a.PNG",
      "expires": 1438927194,
      "originalFileName": "PNG.PNG",
      "fileSize": null,
      "cdn": "http:\/\/cdn.dev.frm.fm\/feedthumbnail\/d422b63c1f7c40984b46c3be627dce9a.PNG"
    },
    "urlName": "Infinite Sunset",
    "createdOn": "2015-08-07 05:59:54",
    "updatedOn": "2016-09-14 09:16:59",
    "thumbWidth": 600,
    "thumbHeight": 450,
    "urlTags": "",
    "userFollowing": {
      "data": [
        {
          "id": 6,
          "roleId": 4,
          "username": "eric",
          "email": "eric.chou127@gmail.com",
          "title": null,
          "firstname": "Eric",
          "lastname": "Chou",
          "image": {},
          "cover": 4194,
          "country": null,
          "zone": null,
          "address": null,
          "zipcode": null,
          "profile": null,
          "bio": null,
          "url": null,
          "amount": 3.4,
          "deposited": 0,
          "lastLogin": "2018-06-18 17:06:15",
          "active": 1,
          "language": "en",
          "specialRoles": 16777215,
          "creationDate": "2015-04-17 09:39:11",
          "modifiedDate": "2017-07-03 16:08:14",
          "activeDate": "2015-07-04 00:00:00",
          "artistNameUrl": "eric_chou_1",
          "organizational": 0,
          "emailNotification": null,
          "deviceRegistered": 1
        }
      ]
    }
  }
}
```

## Create an feeds

|Property Name        | Type           | Description  | Default|Required|
|:--------------|:---------|:------:|----|----|
|url | string|The source you want to add new feed |n/a| yes|
|tags| string|The tags name for this feed|n/a|no|
|private|int|Option for public or private that feed, default is public|0|no|

For example create a new feed:

```
feed.json
{
	"url" : "https://www.youtube.com/watch?v=MLHtYqvvUC0&t=22s",
	"tags" : "aws,acm,cloudflare",
    "name": "Add demo create feed",
    "private" : 0
}
curl "${HOST}/feeds" \
    -X POST \
    -H "Authorization: Bearer 74305f35862b76db" \
    -H "Content-Type: application/json" \
    -d @feed.json
```
Result:

``` 
{
  "data": {
    "id": 2986,
    "url": "https:\/\/www.youtube.com\/watch?v=MLHtYqvvUC0&t=22s",
    "thumb": {
      "id": 4347,
      "key": "feeds\/b2c8f79c61ee74a612e36060b1c31707.png",
      "privacy": "public-read",
      "url": "http:\/\/cdn.dev.frm.fm\/feeds\/b2c8f79c61ee74a612e36060b1c31707.png",
      "expires": 1571092182,
      "originalFileName": "bf7e6f5d7d3ccbd202caca8161867c90.png",
      "fileSize": 128730,
      "cdn": "http:\/\/cdn.dev.frm.fm\/feeds\/b2c8f79c61ee74a612e36060b1c31707.png"
    },
    "name": "Add demo create feed",
    "createdOn": "2019-10-04 15:34:55",
    "updatedOn": null,
    "thumbWidth": null,
    "thumbHeight": null,
    "tags": "aws,acm,cloudflare",
    "userFollowing": {
      "data": [
        {
          "id": 901,
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
      ]
    }
  }
}
```
## Update a feed


```
feed.json
{
	"tags" : "aws,acm,cloudflare",
    "name": "Add demo create feed",
    "private" : 0
}
curl "${HOST}/feeds/268" \
    -X POST \
    -H "Authorization: Bearer 74305f35862b76db" \
    -H "Content-Type: application/json" \
    -d @feed.json
```

Result:

```
{
  "data": {
    "id": 268,
    "url": "http:\/\/infinite-sunset.com",
    "thumb": {
      "id": 738,
      "key": "feedthumbnail\/d422b63c1f7c40984b46c3be627dce9a.PNG",
      "privacy": "public-read",
      "url": "http:\/\/file.frm.fm\/feedthumbnail\/d422b63c1f7c40984b46c3be627dce9a.PNG",
      "expires": 1438927194,
      "originalFileName": "PNG.PNG",
      "fileSize": null,
      "cdn": "http:\/\/cdn.dev.frm.fm\/feedthumbnail\/d422b63c1f7c40984b46c3be627dce9a.PNG"
    },
    "name": "Add demo create feed",
    "createdOn": "2015-08-07 05:59:54",
    "updatedOn": "2019-10-04 16:42:22",
    "thumbWidth": 600,
    "thumbHeight": 450,
    "tags": "aws,acm,cloudflare",
    "userFollowing": {
      "data": [
        {
          "id": 6,
          "roleId": 4,
          "username": "eric",
          "email": "eric.chou127@gmail.com",
          "title": null,
          "firstname": "Eric",
          "lastname": "Chou",
          "image": {},
          "cover": 4194,
          "country": null,
          "zone": null,
          "address": null,
          "zipcode": null,
          "profile": null,
          "bio": null,
          "url": null,
          "amount": 3.4,
          "deposited": 0,
          "lastLogin": "2018-06-18 17:06:15",
          "active": 1,
          "language": "en",
          "specialRoles": 16777215,
          "creationDate": "2015-04-17 09:39:11",
          "modifiedDate": "2017-07-03 16:08:14",
          "activeDate": "2015-07-04 00:00:00",
          "artistNameUrl": "eric_chou_1",
          "organizational": 0,
          "emailNotification": null,
          "deviceRegistered": 1
        }
      ]
    }
  }
} 
```
## Delete a feed

HTTP Request: `DELETE ${HOST}/feeds/{id}`

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
        "message": "Delete feed success",
        "code": 202
    }
}
```
