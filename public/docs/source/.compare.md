---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/LaraSpa/public/docs/collection.json)

<!-- END_INFO -->
<!-- START_AUTHENTICATION -->
# Authentication

## Login

Login to the application

> Example request

```javascript
const url = new URL("http://localhost/LaraSpa/public/oauth/token");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    client_id: 2,
    client_secret: "client secret",
    grant_type: "password",
    password: "some-password",
    username: "some-username"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```
> Example response (200):

```json
{
    "type": "Bearer ",
    "access_token": "AccessToken",
    "refresh_token": "ARefreshToken",
    "expires_in": 332432423
}
```

### HTTP Request
`POST oauth/token`

<!-- END_AUTHENTICATION -->


#General
<!-- START_be144776226f630c3f444c294d8a0395 -->
## Ping pong

Check the ping pong.

> Example request:

```bash
curl -X GET -G "http://localhost/LaraSpa/public/api/ping" 
```

```javascript
const url = new URL("http://localhost/LaraSpa/public/api/ping");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
"pong"
```

### HTTP Request
`GET api/ping`


<!-- END_be144776226f630c3f444c294d8a0395 -->


<!-- START_6b67a10116f49797d9fbe1c2ea7bad28 -->
## Return the current version of the application.

> Example request:

```bash
curl -X GET -G "http://localhost/LaraSpa/public/api/version" 
```

```javascript
const url = new URL("http://localhost/LaraSpa/public/api/version");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "version": "1"
}
```

### HTTP Request
`GET api/version`


<!-- END_6b67a10116f49797d9fbe1c2ea7bad28 -->


#Mobile
<!-- START_4ba3d46ddc57254f5510cbed41b323c5 -->
## Get user logged in user.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Get the info for the current logged in user with allocated optician data.

> Example request:

```bash
curl -X GET -G "http://localhost/LaraSpa/public/api/v1/mobile/user" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://localhost/LaraSpa/public/api/v1/mobile/user");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "id": 1025,
    "name": "Sithira Munasinghe",
    "email": "xyz@xyz.com",
    "provider": "local",
    "avatar": "link_to_avatar.com",
    "optician": {
        "id": 1025,
        "name": "Sithira Munasinghe",
        "email": "zxc@zzxc.com"
    }
}
```
> Example response (403):

```json
{
    "message": "unauthenticated"
}
```
> Example response (404):

```json
{
    "status": "ERROR",
    "message": "Requested resource not found"
}
```

### HTTP Request
`GET api/v1/mobile/user`


<!-- END_4ba3d46ddc57254f5510cbed41b323c5 -->


<!-- START_4667974b1efa9960391ea5072972072f -->
## Get all checkups

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Get all the checkups that the authenticated user is allocated to.

> Example request:

```bash
curl -X GET -G "http://localhost/LaraSpa/public/api/v1/mobile/user/checkups" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL("http://localhost/LaraSpa/public/api/v1/mobile/user/checkups");

let headers = {
    "Authorization": "Bearer {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "id": 123,
    "requested_by": "Sithira munasinghe",
    "user_id": 12,
    "checkup_id": 3,
    "diagnosed_date": "2019-03-30",
    "note": "Some note",
    "checkup": {
        "name": "checkup name",
        "level": 3
    }
}
```
> Example response (403):

```json
{
    "message": "unauthenticated"
}
```
> Example response (404):

```json
{
    "status": "ERROR",
    "message": "Requested resource not found"
}
```

### HTTP Request
`GET api/v1/mobile/user/checkups`


<!-- END_4667974b1efa9960391ea5072972072f -->


<!-- START_9c26cf07230d291ff7bdef696d1d47d9 -->
## Create a checkup

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Authenticated user can create a new checkup.

> Example request:

```bash
curl -X POST "http://localhost/LaraSpa/public/api/v1/mobile/user/checkups" \
    -H "Authorization: Bearer {token}" \
    -H "Content-Type: application/json" \
    -d '{"optician_id":11,"diagnose_date":"jKPb81lL1Mm7Wvhj","note":"TTUlSk1EMF0wC1QG"}'

```

```javascript
const url = new URL("http://localhost/LaraSpa/public/api/v1/mobile/user/checkups");

let headers = {
    "Authorization": "Bearer {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "optician_id": 11,
    "diagnose_date": "jKPb81lL1Mm7Wvhj",
    "note": "TTUlSk1EMF0wC1QG"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (201):

```json
{
    "id": 123,
    "requested_by": "Sithira munasinghe",
    "user_id": 12,
    "checkup_id": 3,
    "diagnosed_date": "2019-03-30",
    "note": "Some note"
}
```
> Example response (403):

```json
{
    "message": "unauthenticated"
}
```
> Example response (404):

```json
{
    "status": "ERROR",
    "message": "Requested resource not found"
}
```

### HTTP Request
`POST api/v1/mobile/user/checkups`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    optician_id | integer |  required  | Optician id
    diagnose_date | string |  required  | Diagnose date
    note | string |  optional  | Note for the other party

<!-- END_9c26cf07230d291ff7bdef696d1d47d9 -->




